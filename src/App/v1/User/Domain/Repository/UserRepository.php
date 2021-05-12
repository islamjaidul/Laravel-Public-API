<?php

namespace App\v1\User\Domain\Repository;

use Illuminate\Support\Facades\Http;
use Shared\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
	/**
	 * Fetch all from data source
	 *
	 * @param $queryString
	 * @return array
	*/
	public function fetchAll(array $queryString = null) : array
	{
		$api = env('ZAMMAD_BASE_API').'/users';

		if (!empty($queryString) && in_array('query', array_keys($queryString))) {
			$api .= '/search/?'.http_build_query($queryString);
		}
		
		$response = Http::withBasicAuth(env('ZAMMAD_EMAIL'), env('ZAMMAD_PASSWORD'))
        ->get($api)
        ->json();

        return $response;
	}

	/**
	 * Fetch a single record
	 * 
	 * @param $id
	 * @return object
	*/
	public function fetchById(int $id) : object
	{
		$api = env('ZAMMAD_BASE_API')."/users/".$id;
		
		$response = Http::withBasicAuth(env('ZAMMAD_EMAIL'), env('ZAMMAD_PASSWORD'))
        ->get($api)
        ->json();

        return (object) $response;
	}

	/**
	 * Create a record
	 *
	 * @param $payload
	 * @return bool
	*/
	public function create(array $payload) : bool
	{
		$api = env('ZAMMAD_BASE_API').'/users';

		$response = Http::withBasicAuth(env('ZAMMAD_EMAIL'), env('ZAMMAD_PASSWORD'))
        ->post($api, $payload);

        return $response->successful();
	}

	/**
	 * Update a record
	 *
	 * @param $payload
	 * @param $id
	 * @return bool
	*/
	public function update(array $payload, int $id) : bool
	{
		$api = env('ZAMMAD_BASE_API')."/users/".$id;

		$response = Http::withBasicAuth(env('ZAMMAD_EMAIL'), env('ZAMMAD_PASSWORD'))
        ->put($api, $payload);

        return $response->successful();
	}

	/**
	 * Delete a record
	 *
	 * @param $id
	 * @return bool
	*/
	public function delete(int $id) : bool
	{
		$api = env('ZAMMAD_BASE_API')."/users/".$id;

		$response = Http::withBasicAuth(env('ZAMMAD_EMAIL'), env('ZAMMAD_PASSWORD'))
        ->delete($api);

        return $response->successful();
	}
}