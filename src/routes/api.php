<?php

Route::group(['prefix' => 'api/v1', 'middleware' => ['api'], 'namespace' => 'professionalweb\IntegrationHub\IntegrationHubAdvCake\Http\Controllers'], static function () {
    Route::get('advcake/export', 'ExportController@index');
});