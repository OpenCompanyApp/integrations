<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Lambdas With Id.
 *
 * Maps to POST /api/lambda/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchLambdasWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_lambdas_with_id',
  'class' => 'FusionAuthSearchLambdasWithId',
  'method' => 'POST',
  'path' => '/api/lambda/search',
  'operation_id' => 'searchLambdasWithId',
  'summary' => 'search Lambdas With Id',
  'description' => 'Searches lambdas with the specified criteria and pagination.',
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
