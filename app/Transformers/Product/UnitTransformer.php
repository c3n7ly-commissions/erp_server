<?php

namespace App\Transformers\Product;

use App\Models\Product\Unit;
use League\Fractal\TransformerAbstract;

class UnitTransformer extends TransformerAbstract
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
  public function transform(Unit $unit)
  {
    return [
      "id" => (int)$unit->id,
      "name" => (string)$unit->name,
      "description" => (string)$unit->description,
      "created_at" => (string)$unit->created_at,
      "updated_at" => (string)$unit->updated_at,
      "deleted_at" => (string)$unit->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("units.show", $unit->id)
        ],
      ]
    ];
  }
}
