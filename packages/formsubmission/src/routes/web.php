<?php

use DissanayakeG\SimpleFormSubmission\Http\Controllers\FormController;

Route::get('contact-form',[FormController::class, 'index'])->name('contact-form');
Route::post('contact-form',[FormController::class, 'send']);
