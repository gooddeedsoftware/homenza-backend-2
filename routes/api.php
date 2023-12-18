<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Banner
    Route::post('banners/media', 'BannerApiController@storeMedia')->name('banners.storeMedia');
    Route::apiResource('banners', 'BannerApiController');

    // Banner Card
    Route::post('banner-cards/media', 'BannerCardApiController@storeMedia')->name('banner-cards.storeMedia');
    Route::apiResource('banner-cards', 'BannerCardApiController');

    // Propert Type
    Route::apiResource('propert-types', 'PropertTypeApiController');

    // Amenities
    Route::apiResource('amenities', 'AmenitiesApiController');

    // Services
    Route::apiResource('services', 'ServicesApiController');

    // Property
    Route::post('properties/media', 'PropertyApiController@storeMedia')->name('properties.storeMedia');
    Route::apiResource('properties', 'PropertyApiController');

    // Enquiries
    Route::apiResource('enquiries', 'EnquiriesApiController');

    // Testimonial
    Route::apiResource('testimonials', 'TestimonialApiController');
});
