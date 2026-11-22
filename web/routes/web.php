<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/ai-secretary', 'pages.ai-secretary')->name('ai-secretary');
Route::view('/whatsapp-agent', 'pages.whatsapp-agent')->name('whatsapp-agent');
Route::view('/website-chat', 'pages.website-chat')->name('website-chat');
Route::view('/call-analytics', 'pages.call-analytics')->name('call-analytics');
Route::view('/pricing', 'pages.pricing')->name('pricing');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

Route::get('/request-a-demo', [LeadController::class, 'create'])->name('demo');
Route::post('/request-a-demo', [LeadController::class, 'store'])->middleware('throttle:5,1')->name('demo.store');
Route::get('/request-a-demo/thank-you', [LeadController::class, 'thanks'])->name('demo.thanks');

Route::get('/sitemap.xml', function () {
    $urls = collect(['home', 'ai-secretary', 'whatsapp-agent', 'website-chat', 'call-analytics', 'pricing', 'demo', 'privacy', 'terms'])
        ->map(fn ($name) => route($name));

    return response()->view('sitemap', ['urls' => $urls])->header('Content-Type', 'application/xml');
})->name('sitemap');
