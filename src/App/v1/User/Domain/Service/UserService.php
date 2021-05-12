<?php

namespace App\v1\User\Domain\Service;

use Shared\Contracts\ServiceContract;
use App\v1\User\Domain\Repository\UserRepository;

class UserService implements ServiceContract
{
	private $repository;

	public function __construct(UserRepository $userRepository)
	{
		$this->repository = $userRepository;
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
	 * @param $id
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