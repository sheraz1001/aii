<?php

namespace App\Http\Controllers;

use App\Mail\CallSummaryMail;
use App\Models\Business;
use App\Models\Call;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/** Endpoints used by the Python voice agent running on the Contabo server. */
class AgentApiController extends Controller
{
    /** GET /api/agent/business?number=+9714XXXXXXX */
    public function business(Request $request): JsonResponse
    {
        $number = Business::normaliseNumber($request->query('number'));
        $business = $number === '' ? null : Business::query()
            ->where('phone_number', $number)
            ->where('is_active', true)
            ->first();

        if (! $business) {
            return response()->json(['message' => 'No business for this number'], 404);
        }

        return response()->json(['data' => $business->toAgentConfig()]);
    }

    /** POST /api/agent/calls — a finished call from the agent. */
    public function storeCall(Request $request): JsonResponse
    {
        $data = $request->validate([
            'business_id' => ['nullable', 'integer', 'exists:businesses,id'],
            'caller_number' => ['nullable', 'string', 'max:40'],
            'called_number' => ['nullable', 'string', 'max:40'],
            'started_at' => ['required', 'numeric'],
            'ended_at' => ['required', 'numeric'],
            'duration_seconds' => ['required', 'integer', 'min:0'],
            'transcript' => ['array'],
            'messages' => ['array'],
            'transferred_to' => ['nullable', 'string', 'max:40'],
            'summary' => ['nullable', 'string', 'max:5000'],
        ]);

        $call = Call::create([
            ...$data,
            'started_at' => Carbon::createFromTimestamp($data['started_at']),
            'ended_at' => Carbon::createFromTimestamp($data['ended_at']),
        ]);

        $owner = $call->business?->owner_email;
        if ($owner) {
            try {
                Mail::to($owner)->send(new CallSummaryMail($call));
            } catch (\Throwable $e) {
                Log::error('Call summary email failed', ['call' => $call->id, 'error' => $e->getMessage()]);
            }
        }

        return response()->json(['data' => ['id' => $call->id]], 201);
    }
}
