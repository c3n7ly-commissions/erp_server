<?php

namespace App\Transformers\Company;

use App\Models\Company\BranchProductLevel;
use League\Fractal\TransformerAbstract;

class BranchProductLevelTransformer extends TransformerAbstract
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
  public function transform(BranchProductLevel $branchProductLevel)
  {
    return [
      "id" => (int)$branchProductLevel->id,
      "minimum_level" => (float)$branchProductLevel->minimum_level,
      "maximum_level" => (float)$branchProductLevel->maximum_level,
      "reorder_level" => (float)$branchProductLevel->reorder_level,
      "quantity" => (float)$branchProductLevel->quantity,
      "branch_id" => (int)$branchProductLevel->branch_id,
      "product_id" => (int)$branchProductLevel->product_id,
      "created_at" => (string)$branchProductLevel->created_at,
      "updated_at" => (string)$branchProductLevel->updated_at,
      "deleted_at" => (string)$branchProductLevel->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("branches.branch_product_levels.show", $branchProductLevel->id)
        ],
        [
          'rel' => "branch",
          "href" => route("branches.show", $branchProductLevel->branch_id)
        ],
        [
          'rel' => "product",
          "href" => route("products.show", $branchProductLevel->product_id)
        ],
      ]
    ];
  }
}
