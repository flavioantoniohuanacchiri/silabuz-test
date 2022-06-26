<?php namespace App\Handlers;


interface EntityInterface {
	public function create($entity = []);
	public function update($entity = [], $entityId = null);
	public function delete($entityId = null);
	public function find($entityId);
}