<?php

namespace App\Transformers\Partners\Supplier;

use App\Models\Partners\Supplier\SupplierProduct;
use League\Fractal\TransformerAbstract;

class SupplierProductTransformer extends TransformerAbstract
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
  public function transform(SupplierProduct $supplierProduct)
  {
    return [
      "id" => (int)$supplierProduct->id,
      "supplier_id" => (int)$supplierProduct->supplier_id,
      "product_id" => (int)$supplierProduct->product_id,
      "created_at" => (string)$supplierProduct->created_at,
      "updated_at" => (string)$supplierProduct->updated_at,
      "deleted_at" => (string)$supplierProduct->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("supplier_products.show", $supplierProduct->id)
        ],
        [
          'rel' => "supplier",
          "href" => route("suppliers.show", $supplierProduct->supplier_id)
        ],
        [
          'rel' => "product",
          "href" => route("products.show", $supplierProduct->product_id)
        ]
      ]
    ];
  }
}
