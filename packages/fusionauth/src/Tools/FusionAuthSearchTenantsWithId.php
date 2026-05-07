<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Tenants With Id.
 *
 * Maps to POST /api/tenant/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchTenantsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_tenants_with_id',
  'class' => 'FusionAuthSearchTenantsWithId',
  'method' => 'POST',
  'path' => '/api/tenant/search',
  'operation_id' => 'searchTenantsWithId',
  'summary' => 'search Tenants With Id',
  'description' => 'Searches tenants with the specified criteria and pagination.',
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
