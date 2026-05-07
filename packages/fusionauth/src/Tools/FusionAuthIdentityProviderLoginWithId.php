<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * identity Provider Login With Id.
 *
 * Maps to POST /api/identity-provider/login in the official FusionAuth OpenAPI document.
 */
class FusionAuthIdentityProviderLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_identity_provider_login_with_id',
  'class' => 'FusionAuthIdentityProviderLoginWithId',
  'method' => 'POST',
  'path' => '/api/identity-provider/login',
  'operation_id' => 'identityProviderLoginWithId',
  'summary' => 'identity Provider Login With Id',
  'description' => 'Handles login via third-parties including Social login, external OAuth and OpenID Connect, and other login systems.',
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
