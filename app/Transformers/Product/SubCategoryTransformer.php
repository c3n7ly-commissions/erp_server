<?php

namespace App\Transformers\Product;

use App\Models\Product\SubCategory;
use League\Fractal\TransformerAbstract;

class SubCategoryTransformer extends TransformerAbstract
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
  public function transform(SubCategory $subcategory)
  {
    return [
      "id" => (int)$subcategory->id,
      "name" => (string)$subcategory->name,
      "created_at" => (string)$subcategory->created_at,
      "updated_at" => (string)$subcategory->updated_at,
      "deleted_at" => (string)$subcategory->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("subcategories.show", $subcategory->id)
        ],
      ]
    ];
  }
}
