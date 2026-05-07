<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * passwordless Login With Id.
 *
 * Maps to POST /api/passwordless/login in the official FusionAuth OpenAPI document.
 */
class FusionAuthPasswordlessLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_passwordless_login_with_id',
  'class' => 'FusionAuthPasswordlessLoginWithId',
  'method' => 'POST',
  'path' => '/api/passwordless/login',
  'operation_id' => 'passwordlessLoginWithId',
  'summary' => 'passwordless Login With Id',
  'description' => 'Complete a login request using a passwordless code',
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
