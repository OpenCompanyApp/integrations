<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * login Ping With Request With Id.
 *
 * Maps to PUT /api/login in the official FusionAuth OpenAPI document.
 */
class FusionAuthLoginPingWithRequestWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_login_ping_with_request_with_id',
  'class' => 'FusionAuthLoginPingWithRequestWithId',
  'method' => 'PUT',
  'path' => '/api/login',
  'operation_id' => 'loginPingWithRequestWithId',
  'summary' => 'login Ping With Request With Id',
  'description' => 'Sends a ping to FusionAuth indicating that the user was automatically logged into an application. When using FusionAuth\'s SSO or your own, you should call this if the user is already logged in centrally, but accesses an application where they no longer have a session. This helps correctly track login counts, times and helps with reporting.',
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
