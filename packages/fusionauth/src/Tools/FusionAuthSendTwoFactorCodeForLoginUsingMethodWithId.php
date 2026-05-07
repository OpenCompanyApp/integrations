<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * send Two Factor Code For Login Using Method With Id.
 *
 * Maps to POST /api/two-factor/send/{twoFactorId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthSendTwoFactorCodeForLoginUsingMethodWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_send_two_factor_code_for_login_using_method_with_id',
  'class' => 'FusionAuthSendTwoFactorCodeForLoginUsingMethodWithId',
  'method' => 'POST',
  'path' => '/api/two-factor/send/{twoFactorId}',
  'operation_id' => 'sendTwoFactorCodeForLoginUsingMethodWithId',
  'summary' => 'send Two Factor Code For Login Using Method With Id',
  'description' => 'Send a Two Factor authentication code to allow the completion of Two Factor authentication.',
  'parameters' =>
  array (
    'two_factor_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id returned by the Login API necessary to complete Two Factor authentication.',
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
    'twoFactorId' => 'two_factor_id',
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
