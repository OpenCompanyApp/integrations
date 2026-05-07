<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * send Passwordless Code With Id.
 *
 * Maps to POST /api/passwordless/send in the official FusionAuth OpenAPI document.
 */
class FusionAuthSendPasswordlessCodeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_send_passwordless_code_with_id',
  'class' => 'FusionAuthSendPasswordlessCodeWithId',
  'method' => 'POST',
  'path' => '/api/passwordless/send',
  'operation_id' => 'sendPasswordlessCodeWithId',
  'summary' => 'send Passwordless Code With Id',
  'description' => 'Send a passwordless authentication code in an email to complete login.',
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
