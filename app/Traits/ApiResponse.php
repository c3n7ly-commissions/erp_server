<?php

namespace App\Traits;

use Symfony\Component\HttpKernel\Exception\HttpException;

trait ApiResponse
{
  private function successResponse($data, $code)
  {
    return response()->json($data, $code);
  }

  protected function errorResponse($message, $code)
  {
    return response()->json(["message" => $message], $code);
  }

  /**
   * show all resources in collection
   * @param \Illuminate\Database\Eloquent\Collection $collection
   * @return \Illuminate\Http\Response
   */
  protected function showAll($collection, $code = 200)
  {
    if ($collection->isEmpty()) {
      return $this->successResponse(['data' => $collection], $code);
    }
    $transformer = $collection->first()->transformer;
    $collection = $this->transformData($collection, $transformer);

    return $this->successResponse($collection, $code);
  }

  /**
   * show all resources in collection
   * @param \Illuminate\Database\Eloquent\Model $instance
   * @return \Illuminate\Http\Response
   */
  protected function showOne($instance, $code = 200)
  {
    $transformer = $instance->transformer;
    $instance = $this->transformData($instance, $transformer);
    return $this->successResponse($instance, $code);
  }

  private function transformData($data, $transformer)
  {
    $transformation = fractal($data, new $transformer);
    return $transformation->toArray();
  }

  // TODO: Migrate old controllers to use these instead
  protected function showStatusReasonRequired($trigger_status)
  {
    return $this->errorResponse(
      "when the status field is " . $trigger_status . ", the status_reason field is required",
      422
    );
  }

  protected function showUnchangedError()
  {
    return $this->errorResponse('you need to specify different values to update', 422);
  }

  protected function showRelationshipError($model_a, $model_b)
  {
    throw new HttpException(
      422,
      'there exists no relationship between the passed ' . $model_a . ' and ' . $model_b
    );
  }
}
