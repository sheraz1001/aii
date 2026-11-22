<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['languages' => 'array', 'is_active' => 'boolean'];
    }

    public function calls(): HasMany
    {
        return $this->hasMany(Call::class);
    }

    /** Normalise a phone number to +digits so lookups match. */
    public static function normaliseNumber(?string $number): string
    {
        $digits = preg_replace('/\D+/', '', (string) $number);

        return $digits === '' ? '' : '+'.$digits;
    }

    /** Settings the voice agent needs (see agent/demo_business.json). */
    public function toAgentConfig(): array
    {
        return $this->only([
            'id', 'name', 'assistant_name', 'description', 'location', 'hours',
            'services_and_prices', 'faqs', 'booking_rules', 'transfer_number',
            'languages', 'stt_language', 'tts_voice_id', 'extra_instructions',
        ]);
    }
}
