<?php

namespace Shared\Contracts;

interface ServiceContract
{
	/**
	 * Get collection
	 *
	 * @param $queryString
	 * @return array
	*/
	public function handleAll(array $queryString = null) : array;

	/**
	 * Get a single record
	 *
	 * @param $id
	 * @return object
	*/
	public function handleFind(int|string $id) : object;

	/**
	 * Create a record
	 *
	 * @param $payload
	 * @return bool
	*/
	public function handleCreate(array $payload) : bool;

	/**
	 * Update a record
	 *
	 * @param $payload
	 * @return bool
	*/
	public function handleUpdate(array $payload, int $id) : bool;

	/**
	 * Delete a record
	 *
	 * @param $id
	 * @return bool
	*/
	public function handleDelete(int $id) : bool;
}