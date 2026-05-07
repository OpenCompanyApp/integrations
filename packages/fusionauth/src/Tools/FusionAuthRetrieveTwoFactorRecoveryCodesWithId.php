<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Two Factor Recovery Codes With Id.
 *
 * Maps to GET /api/user/two-factor/recovery-code/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveTwoFactorRecoveryCodesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_two_factor_recovery_codes_with_id',
  'class' => 'FusionAuthRetrieveTwoFactorRecoveryCodesWithId',
  'method' => 'GET',
  'path' => '/api/user/two-factor/recovery-code/{userId}',
  'operation_id' => 'retrieveTwoFactorRecoveryCodesWithId',
  'summary' => 'retrieve Two Factor Recovery Codes With Id',
  'description' => 'Retrieve two-factor recovery codes for a user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user to retrieve Two Factor recovery codes.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
