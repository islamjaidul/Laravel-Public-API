<?php

namespace App\v1\User\Responder;

use Shared\Http\Responders\ApiResponder;
use App\v1\User\Responder\Transformers\AllUserTransformer;
use App\v1\User\Responder\Transformers\SingleUserTransformer;

class UserResponder extends ApiResponder
{
	public function respondAll(array $collection)
	{
		return $this
		->respondWithCollection($collection, new AllUserTransformer)
		->setStatusCode(200);
	}

	public function respondFind(object $item) 
	{
		return $this
		->respondWithItem($item, new SingleUserTransformer)
		->setStatusCode(200);
	}

	public function respondStore(bool $isSaved)
	{
		if ($isSaved) {
			return $this
			->respond()
			->setStatusCode(201);
		}

		throw new \Exception("The user has not been stored! May be the email address has been used before");
	}

	public function respondUpdate(bool $isUpdated)
	{
		if ($isUpdated) {
			return $this
			->respond()
			->setStatusCode(200);
		}

		throw new \Exception("The user has not been updated! May be the email address has been used before");
	}

	public function respondDelete(bool $isDeleted)
	{
		if ($isDeleted) {
			return $this
			->respond()
			->setStatusCode(200);
		}

		throw new \Exception("Change was rejected. The user cannot be found or you might need to delete related tickets before");
	}
}