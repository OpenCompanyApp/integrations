<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * start Passwordless Login With Id.
 *
 * Maps to POST /api/passwordless/start in the official FusionAuth OpenAPI document.
 */
class FusionAuthStartPasswordlessLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_start_passwordless_login_with_id',
  'class' => 'FusionAuthStartPasswordlessLoginWithId',
  'method' => 'POST',
  'path' => '/api/passwordless/start',
  'operation_id' => 'startPasswordlessLoginWithId',
  'summary' => 'start Passwordless Login With Id',
  'description' => 'Start a passwordless login request by generating a passwordless code. This code can be sent to the User using the Send Passwordless Code API or using a mechanism outside of FusionAuth. The passwordless login is completed by using the Passwordless Login API with this code.',
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
