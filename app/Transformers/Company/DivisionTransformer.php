<?php

namespace App\Transformers\Company;

use App\Models\Company\Division;
use League\Fractal\TransformerAbstract;

class DivisionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Division $division)
    {
        return [
            "name" => (string)$division->name
        ];
    }
}
