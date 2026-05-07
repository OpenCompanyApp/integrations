<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * login With Id.
 *
 * Maps to POST /api/login in the official FusionAuth OpenAPI document.
 */
class FusionAuthLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_login_with_id',
  'class' => 'FusionAuthLoginWithId',
  'method' => 'POST',
  'path' => '/api/login',
  'operation_id' => 'loginWithId',
  'summary' => 'login With Id',
  'description' => 'Authenticates a user to FusionAuth. This API optionally requires an API key. See Application.loginConfiguration.requireAuthentication.',
  'parameters' =>
  array (
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
