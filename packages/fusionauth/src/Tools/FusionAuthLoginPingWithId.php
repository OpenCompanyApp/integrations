<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * login Ping With Id.
 *
 * Maps to PUT /api/login/{userId}/{applicationId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthLoginPingWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_login_ping_with_id',
  'class' => 'FusionAuthLoginPingWithId',
  'method' => 'PUT',
  'path' => '/api/login/{userId}/{applicationId}',
  'operation_id' => 'loginPingWithId',
  'summary' => 'login Ping With Id',
  'description' => 'Sends a ping to FusionAuth indicating that the user was automatically logged into an application. When using FusionAuth\'s SSO or your own, you should call this if the user is already logged in centrally, but accesses an application where they no longer have a session. This helps correctly track login counts, times and helps with reporting.',
  'parameters' =>
  array (
    'caller_ipaddress' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The IP address of the end-user that is logging in. If a null value is provided the IP address will be that of the client or last proxy that sent the request.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user that was logged in.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application that they logged into.',
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
    'userId' => 'user_id',
    'applicationId' => 'application_id',
  ),
  'query_params' =>
  array (
    'callerIPAddress' => 'caller_ipaddress',
  ),
  'header_params' =>
  array (
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
