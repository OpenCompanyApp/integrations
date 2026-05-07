<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * enable Two Factor With Id.
 *
 * Maps to POST /api/user/two-factor/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthEnableTwoFactorWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_enable_two_factor_with_id',
  'class' => 'FusionAuthEnableTwoFactorWithId',
  'method' => 'POST',
  'path' => '/api/user/two-factor/{userId}',
  'operation_id' => 'enableTwoFactorWithId',
  'summary' => 'enable Two Factor With Id',
  'description' => 'Enable two-factor authentication for a user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user to enable two-factor authentication.',
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
    'userId' => 'user_id',
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
