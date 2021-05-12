<?php

namespace App\v1\Ticket\Domain\Service;

use Shared\Contracts\ServiceContract;
use App\v1\Ticket\Domain\Repository\TicketRepository;

class TicketService implements ServiceContract
{
	private $repository;

	public function __construct(TicketRepository $ticketRepository)
	{
		$this->repository = $ticketRepository;
	}

	/**
	 * Get collection
	 *
	 * @param $queryString
	 * @return array
	*/
	public function handleAll(array $queryString = null) : array
	{
		return $this->repository->fetchAll($queryString);
	}

	/**
	 * Get a single record
	 *
	 * @param $id
	 * @return object
	*/
	public function handleFind(int $id) : object
	{
		return $this->repository->fetchById($id);
	}

	/**
	 * Create a record
	 *
	 * @param $payload
	 * @return bool
	*/
	public function handleCreate(array $payload) : bool
	{
		return $this->repository->create($payload);
	}

	/**
	 * Update a record
	 *
	 * @param $payload
	 * @return bool
	*/
	public function handleUpdate(array $payload, int $id) : bool
	{
		return $this->repository->update($payload, $id);
	}

	/**
	 * Delete a record
	 *
	 * @param $id
	 * @return bool
	*/
	public function handleDelete(int $id) : bool
	{
		return $this->repository->delete($id);
	}
}