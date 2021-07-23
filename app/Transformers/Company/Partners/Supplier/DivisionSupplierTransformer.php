<?php

namespace App\Transformers\Company\Partners\Supplier;

use App\Models\Company\Partners\Supplier\DivisionSupplier;
use League\Fractal\TransformerAbstract;

class DivisionSupplierTransformer extends TransformerAbstract
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
  public function transform(DivisionSupplier $divisionSupplier)
  {
    return [
      "id" => (int)$divisionSupplier->id,
      "division_id" => (int)$divisionSupplier->division_id,
      "supplier_id" => (int)$divisionSupplier->supplier_id,
      "created_at" => (string)$divisionSupplier->created_at,
      "updated_at" => (string)$divisionSupplier->updated_at,
      "deleted_at" => (string)$divisionSupplier->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("division_suppliers.show", $divisionSupplier->id)
        ],
        [
          'rel' => "division",
          "href" => route("divisions.show", $divisionSupplier->division_id)
        ],
        [
          'rel' => "suppliers",
          "href" => route("suppliers.show", $divisionSupplier->supplier_id)
        ],
      ]
    ];
  }
}
