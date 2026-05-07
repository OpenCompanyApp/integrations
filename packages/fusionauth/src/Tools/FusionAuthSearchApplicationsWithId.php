<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Applications With Id.
 *
 * Maps to POST /api/application/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchApplicationsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_applications_with_id',
  'class' => 'FusionAuthSearchApplicationsWithId',
  'method' => 'POST',
  'path' => '/api/application/search',
  'operation_id' => 'searchApplicationsWithId',
  'summary' => 'search Applications With Id',
  'description' => 'Searches applications with the specified criteria and pagination.',
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
