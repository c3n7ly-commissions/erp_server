<?php

namespace App\Transformers\Partners\Supplier;

use App\Models\Partners\Supplier\Supplier;
use League\Fractal\TransformerAbstract;

class SupplierTransformer extends TransformerAbstract
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
  public function transform(Supplier $supplier)
  {
    return [
      "id" => (int)$supplier->id,
      "name" => (string)$supplier->name,
      "email" => (string)$supplier->email,
      "telephone" => (string)$supplier->telephone,
      "postal_address" => (string)$supplier->postal_address,
      "physical_address" => (string)$supplier->physical_address,
      "tax_id" => (string)$supplier->tax_id,
      "status" => (string)$supplier->status,
      "status_reason" => (string)$supplier->status_reason,
      "payment_terms" => (float)$supplier->payment_terms,
      "credit_limit" => (float)$supplier->credit_limit,
      "created_at" => (string)$supplier->created_at,
      "updated_at" => (string)$supplier->updated_at,
      "deleted_at" => (string)$supplier->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("suppliers.show", $supplier->id)
        ],
        [
          'rel' => "suppliers.division_suppliers",
          // "href" => route("suppliers.division_suppliers.index", $supplier->id)
        ],
      ]
    ];
  }
}
