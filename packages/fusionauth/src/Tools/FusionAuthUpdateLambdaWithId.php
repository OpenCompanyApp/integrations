<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Lambda With Id.
 *
 * Maps to PUT /api/lambda/{lambdaId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateLambdaWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_lambda_with_id',
  'class' => 'FusionAuthUpdateLambdaWithId',
  'method' => 'PUT',
  'path' => '/api/lambda/{lambdaId}',
  'operation_id' => 'updateLambdaWithId',
  'summary' => 'update Lambda With Id',
  'description' => 'Updates the lambda with the given Id.',
  'parameters' =>
  array (
    'lambda_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the lambda to update.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'lambdaId' => 'lambda_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
