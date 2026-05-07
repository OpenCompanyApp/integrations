<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Lambda With Id.
 *
 * Maps to GET /api/lambda/{lambdaId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveLambdaWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_lambda_with_id',
  'class' => 'FusionAuthRetrieveLambdaWithId',
  'method' => 'GET',
  'path' => '/api/lambda/{lambdaId}',
  'operation_id' => 'retrieveLambdaWithId',
  'summary' => 'retrieve Lambda With Id',
  'description' => 'Retrieves the lambda for the given Id.',
  'parameters' =>
  array (
    'lambda_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the lambda.',
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
  'type' => 'read',
);
}
