<?php

namespace App\v1\Report\Responder\Transformers;

use League\Fractal\TransformerAbstract;

class AllReportTransformer extends TransformerAbstract
{
	public function transform(array $report) : array
	{
		$report = (object) $report;

		return [
			'id' 			=> 1,
			'demo_response' => 'Demo response will be like that'
		];
	}
}