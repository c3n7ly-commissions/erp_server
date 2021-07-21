<?php

namespace App\Transformers\Product;

use App\Models\Product\Tax;
use League\Fractal\TransformerAbstract;

class TaxTransformer extends TransformerAbstract
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
  public function transform(Tax $tax)
  {
    return [
      "id" => (int)$tax->id,
      "name" => (string)$tax->name,
      "value" => (float)$tax->value,
      "created_at" => (string)$tax->created_at,
      "updated_at" => (string)$tax->updated_at,
      "deleted_at" => (string)$tax->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("taxes.show", $tax->id)
        ],
      ]
    ];
  }
}
