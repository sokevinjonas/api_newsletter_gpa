<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', [LeadController::class, 'index'])->name('admin.leads');
Route::post('/leads/send-campaign', [LeadController::class, 'sendCampaign'])->name('admin.leads.sendCampaign');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');

