<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * send Two Factor Code For Enable Disable With Id.
 *
 * Maps to POST /api/two-factor/send in the official FusionAuth OpenAPI document.
 */
class FusionAuthSendTwoFactorCodeForEnableDisableWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_send_two_factor_code_for_enable_disable_with_id',
  'class' => 'FusionAuthSendTwoFactorCodeForEnableDisableWithId',
  'method' => 'POST',
  'path' => '/api/two-factor/send',
  'operation_id' => 'sendTwoFactorCodeForEnableDisableWithId',
  'summary' => 'send Two Factor Code For Enable Disable With Id',
  'description' => 'Send a Two Factor authentication code to assist in setting up Two Factor authentication or disabling.',
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
