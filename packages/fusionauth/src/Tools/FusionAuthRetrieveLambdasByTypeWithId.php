<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Lambdas By Type With Id.
 *
 * Maps to GET /api/lambda in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveLambdasByTypeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_lambdas_by_type_with_id',
  'class' => 'FusionAuthRetrieveLambdasByTypeWithId',
  'method' => 'GET',
  'path' => '/api/lambda',
  'operation_id' => 'retrieveLambdasByTypeWithId',
  'summary' => 'retrieve Lambdas By Type With Id',
  'description' => 'Retrieves all the lambdas for the provided type.',
  'parameters' =>
  array (
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The type of the lambda to return.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'type' => 'type',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
