<?php

namespace App\Transformers\Company;

use App\Models\Company\Branch;
use League\Fractal\TransformerAbstract;

class BranchTransformer extends TransformerAbstract
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
  public function transform(Branch $branch)
  {
    return [
      "id" => (int)$branch->id,
      "name" => (string)$branch->name,
      "email" => (string)$branch->email,
      "telephone" => (string)$branch->telephone,
      "postal_address" => (string)$branch->postal_address,
      "physical_address" => (string)$branch->physical_address,
      "division_id" => (string)$branch->division_id,
      "created_at" => (string)$branch->created_at,
      "updated_at" => (string)$branch->updated_at,
      "deleted_at" => (string)$branch->deleted_at,

      "links"  => [
        [
          'rel' => "self",
          "href" => route("branches.show", $branch->id)
        ],
        [
          "rel" => "division",
          "href" => route("divisions.show", $branch->division_id)
        ]
      ],
    ];
  }
}
