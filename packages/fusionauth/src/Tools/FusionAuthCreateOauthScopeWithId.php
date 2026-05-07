<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create OAuth Scope With Id.
 *
 * Maps to POST /api/application/{applicationId}/scope/{scopeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateOauthScopeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_oauth_scope_with_id',
  'class' => 'FusionAuthCreateOauthScopeWithId',
  'method' => 'POST',
  'path' => '/api/application/{applicationId}/scope/{scopeId}',
  'operation_id' => 'createOAuthScopeWithId',
  'summary' => 'create OAuth Scope With Id',
  'description' => 'Creates a new custom OAuth scope for an application. You must specify the Id of the application you are creating the scope for. You can optionally specify an Id for the OAuth scope on the URL, if not provided one will be generated.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application to create the OAuth scope on.',
    ),
    'scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the OAuth scope. If not provided a secure random UUID will be generated.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
