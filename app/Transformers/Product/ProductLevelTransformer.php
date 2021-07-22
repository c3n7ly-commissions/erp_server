<?php

namespace App\Transformers\Product;

use App\Models\Product\ProductLevel;
use League\Fractal\TransformerAbstract;

class ProductLevelTransformer extends TransformerAbstract
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
  public function transform(ProductLevel $productLevel)
  {
    return [
      "id" => (int)$productLevel->id,
      "minimum_level" => (float)$productLevel->minimum_level,
      "maximum_level" => (float)$productLevel->maximum_level,
      "reorder_level" => (float)$productLevel->reorder_level,
      "quantity" => (float)$productLevel->quantity,
      "branch_id" => (int)$productLevel->branch_id,
      "product_id" => (int)$productLevel->product_id,
      "created_at" => (string)$productLevel->created_at,
      "updated_at" => (string)$productLevel->updated_at,
      "deleted_at" => (string)$productLevel->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("product_levels.show", $productLevel->id)
        ],
        [
          'rel' => "branch",
          "href" => route("branches.show", $productLevel->branch_id)
        ],
        [
          'rel' => "product",
          "href" => route("products.show", $productLevel->product_id)
        ],
      ]
    ];
  }
}
