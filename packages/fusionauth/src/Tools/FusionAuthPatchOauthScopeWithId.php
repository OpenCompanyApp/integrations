<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch OAuth Scope With Id.
 *
 * Maps to PATCH /api/application/{applicationId}/scope/{scopeId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchOauthScopeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_oauth_scope_with_id',
  'class' => 'FusionAuthPatchOauthScopeWithId',
  'method' => 'PATCH',
  'path' => '/api/application/{applicationId}/scope/{scopeId}',
  'operation_id' => 'patchOAuthScopeWithId',
  'summary' => 'patch OAuth Scope With Id',
  'description' => 'Updates, via PATCH, the custom OAuth scope with the given Id for the application.',
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
      'description' => 'The Id of the OAuth scope to update.',
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
