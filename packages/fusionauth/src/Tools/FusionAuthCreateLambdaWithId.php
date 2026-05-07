<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Lambda With Id.
 *
 * Maps to POST /api/lambda/{lambdaId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateLambdaWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_lambda_with_id',
  'class' => 'FusionAuthCreateLambdaWithId',
  'method' => 'POST',
  'path' => '/api/lambda/{lambdaId}',
  'operation_id' => 'createLambdaWithId',
  'summary' => 'create Lambda With Id',
  'description' => 'Creates a Lambda. You can optionally specify an Id for the lambda, if not provided one will be generated.',
  'parameters' =>
  array (
    'lambda_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the lambda. If not provided a secure random UUID will be generated.',
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
