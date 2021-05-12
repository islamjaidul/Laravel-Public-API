<?php

Route::group([
	'prefix' => 'v1'
], function() {
	Route::resource('users', 'App\v1\User\Action\UserAction');
	Route::resource('tickets', 'App\v1\Ticket\Action\TicketAction');
	Route::resource('reports', 'App\v1\Report\Action\ReportAction');
});