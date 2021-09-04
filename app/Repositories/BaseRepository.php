<?php


namespace App\Repositories;
use Illuminate\Database\Eloquent\Builder;


interface BaseRepository
{
    /**
     * @param  int $id
     * @return $model
     */
    public function find($id);

    /**
     * Return a collection of all elements of the resource
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * @return Builder
     */
    public function allWithBuilder() : Builder;

    /**
     * Paginate the model to $perPage items per page
     * @param  int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($items, $perPage, $page ,$url, $options = []);

    /**
     * Create a resource
     * @param  $data
     * @return $model
     */
    public function create($data);    
    /**
     * Create a resource
     * @param  $data
     * @return $model
     */
    public function updateOrCreate(array $attributes,array $data);
	/**
	 * Create a resource
	 * @param  $data
	 * @return bool
	 */
	public function createMany($data);
    /**
     * Update a resource
     * @param  $model
     * @param  array $data
     * @return $model
     */
    public function update($model, $data);

    /**
     * Destroy a resource
     * @param  $model
     * @return bool
     */
    public function destroy($model);


    /**
     * Find a resource by the given slug
     * @param  string $slug
     * @return $model
     */
    public function findBySlug($slug);

    /**
     * Find a resource by an array of attributes
     * @param  array $attributes
     * @return $model
     */
    public function findByAttributes(array $attributes);

    /**
     * Return a collection of elements who's ids match
     * @param  array $ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByMany(array $ids);

    /**
     * Get resources by an array of attributes
     * @param  array $attributes
     * @param  null|string $orderBy
     * @param  string $sortOrder
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc');

    /**
     * Clear the cache for this Repositories' Entity
     * @return bool
     */
    public function clearCache();
}
