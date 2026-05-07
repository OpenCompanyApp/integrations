<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Lambda With Id.
 *
 * Maps to DELETE /api/lambda/{lambdaId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteLambdaWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_lambda_with_id',
  'class' => 'FusionAuthDeleteLambdaWithId',
  'method' => 'DELETE',
  'path' => '/api/lambda/{lambdaId}',
  'operation_id' => 'deleteLambdaWithId',
  'summary' => 'delete Lambda With Id',
  'description' => 'Deletes the lambda for the given Id.',
  'parameters' =>
  array (
    'lambda_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the lambda to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
