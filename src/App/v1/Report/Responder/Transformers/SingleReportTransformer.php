<?php

namespace App\v1\Report\Responder\Transformers;

use League\Fractal\TransformerAbstract;

class SingleReportTransformer extends TransformerAbstract
{
	public function transform(object $report) : array
	{
		return [
			'id' 			=> 1,
			'demo_response' => 'Demo report response will be like that'
		];
	}
}