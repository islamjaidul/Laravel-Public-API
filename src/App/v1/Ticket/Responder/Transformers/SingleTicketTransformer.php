<?php

namespace App\v1\Ticket\Responder\Transformers;

use League\Fractal\TransformerAbstract;

class SingleTicketTransformer extends TransformerAbstract
{
	public function transform(object $ticket) : array
	{
		return [
			'id' 			=> 1,
			'demo_response' => 'Demo ticket response will be like that'
		];
	}
}