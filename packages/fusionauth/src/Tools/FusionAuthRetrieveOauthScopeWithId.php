<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve OAuth Scope With Id.
 *
 * Maps to GET /api/application/{applicationId}/scope/{scopeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveOauthScopeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_oauth_scope_with_id',
  'class' => 'FusionAuthRetrieveOauthScopeWithId',
  'method' => 'GET',
  'path' => '/api/application/{applicationId}/scope/{scopeId}',
  'operation_id' => 'retrieveOAuthScopeWithId',
  'summary' => 'retrieve OAuth Scope With Id',
  'description' => 'Retrieves a custom OAuth scope.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application that the OAuth scope belongs to.',
    ),
    'scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the OAuth scope to retrieve.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
  ),
  'path_params' =>
  array (
    'applicationId' => 'application_id',
    'scopeId' => 'scope_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
