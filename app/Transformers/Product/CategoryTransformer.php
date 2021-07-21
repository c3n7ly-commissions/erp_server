<?php

namespace App\Transformers\Product;

use App\Models\Product\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
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
  public function transform(Category $category)
  {
    return [
      "id" => (int)$category->id,
      "name" => (int)$category->name,
      "created_at" => (string)$category->created_at,
      "updated_at" => (string)$category->updated_at,
      "deleted_at" => (string)$category->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("categories.show", $category->id)
        ],
      ]
    ];
  }
}
