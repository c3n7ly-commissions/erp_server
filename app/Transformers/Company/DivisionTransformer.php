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
      "id" => (int)$division->id,
      "name" => (string)$division->name,
      "created_at" => (string)$division->created_at,
      "updated_at" => (string)$division->updated_at,
      "deleted_at" => (string)$division->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("divisions.show", $division->id)
        ],
        [
          "rel" => "divisions.branches",
          "href" => route("divisions.branches.index", $division->id)
        ],
        [
          "rel" => "divisions.products",
          "href" => route("divisions.products.index", $division->id)
        ],
        [
          "rel" => "divisions.division_suppliers",
          "href" => route("divisions.division_suppliers.index", $division->id)
        ]
      ]
    ];
  }
}
