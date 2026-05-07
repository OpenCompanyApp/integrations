<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * start Two Factor Login With Id.
 *
 * Maps to POST /api/two-factor/start in the official FusionAuth OpenAPI document.
 */
class FusionAuthStartTwoFactorLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_start_two_factor_login_with_id',
  'class' => 'FusionAuthStartTwoFactorLoginWithId',
  'method' => 'POST',
  'path' => '/api/two-factor/start',
  'operation_id' => 'startTwoFactorLoginWithId',
  'summary' => 'start Two Factor Login With Id',
  'description' => 'Start a Two-Factor login request by generating a two-factor identifier. This code can then be sent to the Two Factor Send API (/api/two-factor/send)in order to send a one-time use code to a user. You can also use one-time use code returned to send the code out-of-band. The Two-Factor login is completed by making a request to the Two-Factor Login API (/api/two-factor/login). with the two-factor identifier and the one-time use code. This API is intended to allow you to begin a Two-Factor login out',
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
