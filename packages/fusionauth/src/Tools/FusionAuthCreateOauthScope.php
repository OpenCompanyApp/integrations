<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create OAuth Scope.
 *
 * Maps to POST /api/application/{applicationId}/scope in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateOauthScope extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_oauth_scope',
  'class' => 'FusionAuthCreateOauthScope',
  'method' => 'POST',
  'path' => '/api/application/{applicationId}/scope',
  'operation_id' => 'createOAuthScope',
  'summary' => 'create OAuth Scope',
  'description' => 'Creates a new custom OAuth scope for an application. You must specify the Id of the application you are creating the scope for. You can optionally specify an Id for the OAuth scope on the URL, if not provided one will be generated.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application to create the OAuth scope on.',
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
