<?php

namespace App\Transformers\Product;

use App\Models\Product\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
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
  public function transform(Product $product)
  {
    return [
      "id" => (int)$product->id,
      "name" => (string)$product->name,
      "code" => (string)$product->name,
      "bulk_weight" => (float)$product->bulk_weight,
      "conversion" => (float)$product->conversion,
      "bulk_selling_price" => (float)$product->bulk_selling_price,
      "atomic_selling_price" => (float)$product->atomic_selling_price,
      "exp_amount_before_tax" => (float)$product->exp_amount_before_tax,
      "exp_purchase_price" => (float)$product->exp_purchase_price,
      "exp_profit_margin" => (float)$product->exp_profit_margin,
      "status" => (string)$product->status,
      "status_reason" => (string)$product->status_reason,
      "division_id" => (int)$product->division_id,
      "tax_id" => (int)$product->tax_id,
      "category_id" => (int)$product->category_id,
      "sub_category_id" => (int)$product->sub_category_id,
      "bulk_unit_id" => (int)$product->bulk_unit_id,
      "atomic_unit_id" => (int)$product->atomic_unit_id,
      "image" => (string)$product->image,
      "created_at" => (string)$product->created_at,
      "updated_at" => (string)$product->updated_at,
      "deleted_at" => (string)$product->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("products.show", $product->id)
        ],
        [
          'rel' => "division",
          "href" => route("divisions.show", $product->division_id)
        ],
        [
          'rel' => "tax",
          "href" => route("taxes.show", $product->tax_id)
        ],
        [
          'rel' => "category",
          "href" => route("categories.show", $product->category_id)
        ],
        [
          'rel' => "sub_category",
          "href" => route("subcategories.show", $product->sub_category_id)
        ],
        [
          'rel' => "bulk_unit",
          "href" => route("units.show", $product->bulk_unit_id)
        ],
        [
          'rel' => "atomic_unit",
          "href" => route("units.show", $product->atomic_unit_id)
        ],
      ]
    ];
  }
}
