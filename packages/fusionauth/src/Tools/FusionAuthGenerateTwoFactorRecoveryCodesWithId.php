<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * generate Two Factor Recovery Codes With Id.
 *
 * Maps to POST /api/user/two-factor/recovery-code/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthGenerateTwoFactorRecoveryCodesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_generate_two_factor_recovery_codes_with_id',
  'class' => 'FusionAuthGenerateTwoFactorRecoveryCodesWithId',
  'method' => 'POST',
  'path' => '/api/user/two-factor/recovery-code/{userId}',
  'operation_id' => 'generateTwoFactorRecoveryCodesWithId',
  'summary' => 'generate Two Factor Recovery Codes With Id',
  'description' => 'Generate two-factor recovery codes for a user. Generating two-factor recovery codes will invalidate any existing recovery codes.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user to generate new Two Factor recovery codes.',
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
  'type' => 'write',
);
}
