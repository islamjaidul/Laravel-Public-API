<?php

namespace App\v1\Ticket\Responder\Transformers;

use League\Fractal\TransformerAbstract;

class AllTicketTransformer extends TransformerAbstract
{
	public function transform(array $ticket) : array
	{
		$ticket = (object) $ticket;

		return [
			'id' 			=> 1,
			'demo_response' => 'Demo response will be like that'
		];
	}
}