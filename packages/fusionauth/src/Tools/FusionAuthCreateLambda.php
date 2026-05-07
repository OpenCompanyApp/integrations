<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Lambda.
 *
 * Maps to POST /api/lambda in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateLambda extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_lambda',
  'class' => 'FusionAuthCreateLambda',
  'method' => 'POST',
  'path' => '/api/lambda',
  'operation_id' => 'createLambda',
  'summary' => 'create Lambda',
  'description' => 'Creates a Lambda. You can optionally specify an Id for the lambda, if not provided one will be generated.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
