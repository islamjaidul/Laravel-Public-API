<?php

namespace App\v1\Ticket\Domain\Repository;

use Illuminate\Support\Facades\Http;
use Shared\Repositories\BaseRepository;

class TicketRepository extends BaseRepository
{
	/**
	 * Fetch all from data source
	 *
	 * @param $queryString
	 * @return array
	*/
	public function fetchAll(array $queryString = null) : array
	{
		// @todo
		return [];
	}

	/**
	 * Fetch a single record
	 * 
	 * @param $id
	 * @return object
	*/
	public function fetchById(int $id) : object
	{
		// @todo
		return (object) [];
	}

	/**
	 * Create a record
	 *
	 * @param $payload
	 * @return bool
	*/
	public function create(array $payload) : bool
	{
		// @todo
		return true;
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
		// @todo
		return true;
	}

	/**
	 * Delete a record
	 *
	 * @param $id
	 * @return bool
	*/
	public function delete(int $id) : bool
	{
		// @todo
		return true;
	}
}