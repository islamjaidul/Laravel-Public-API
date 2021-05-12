<?php

namespace App\v1\Ticket\Responder;

use Shared\Http\Responders\ApiResponder;
use App\v1\Ticket\Responder\Transformers\AllTicketTransformer;
use App\v1\Ticket\Responder\Transformers\SingleTicketTransformer;

class TicketResponder extends ApiResponder
{
	public function respondAll(array $collection)
	{
		return $this
		->respondWithCollection($collection, new AllTicketTransformer)
		->setStatusCode(200);
	}

	public function respondFind(object $item) 
	{
		return $this
		->respondWithItem($item, new SingleTicketTransformer)
		->setStatusCode(200);
	}

	public function respondStore(bool $isSaved)
	{
		if ($isSaved) {
			return $this
			->respond()
			->setStatusCode(201);
		}

		throw new \Exception("The ticket has not been stored! May be the email address has been used before");
	}

	public function respondUpdate(bool $isUpdated)
	{
		if ($isUpdated) {
			return $this
			->respond()
			->setStatusCode(200);
		}

		throw new \Exception("The ticket has not been updated!");
	}

	public function respondDelete(bool $isDeleted)
	{
		if ($isDeleted) {
			return $this
			->respond()
			->setStatusCode(200);
		}

		throw new \Exception("Change was rejected. The ticket cannot be deleted");
	}
}