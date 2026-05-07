<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Identity Providers With Id.
 *
 * Maps to POST /api/identity-provider/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchIdentityProvidersWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_identity_providers_with_id',
  'class' => 'FusionAuthSearchIdentityProvidersWithId',
  'method' => 'POST',
  'path' => '/api/identity-provider/search',
  'operation_id' => 'searchIdentityProvidersWithId',
  'summary' => 'search Identity Providers With Id',
  'description' => 'Searches identity providers with the specified criteria and pagination.',
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
