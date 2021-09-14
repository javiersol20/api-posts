<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ApiTraits{
    public function scopeIncluded(Builder $query)
    {

        if (empty($this->allowInclude) || empty(request('included')))
        {
            return;
        }
        $relations = explode(',',request('included'));

        $allowIncluded = collect($this->allowInclude);

        foreach ($relations as $key => $relationShip)
        {
            if(!$allowIncluded->contains($relationShip))
            {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter')))
        {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if($allowFilter->contains($filter))
            {
                $query->where($filter, "LIKE", "%" . $value . "%");
            }
        }
    }

    public function scopeSort(Builder $query)
    {
        if (empty($this->allowSort) || empty(request('sort')))
        {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            $direction = "asc";

            if(substr($sortField,0,1) == '-')
            {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }
            if ($allowSort->contains($sortField))
            {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    public function scopeGetOrPaginate(Builder $query)
    {
        if(request('perPage'))
        {
            $perPage = intval(request('perPage'));

            if($perPage)
            {
                return $query->paginate($perPage);
            }
        }
        return $query->get();
    }
}
