<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch User Consent With Id.
 *
 * Maps to PATCH /api/user/consent/{userConsentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchUserConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_user_consent_with_id',
  'class' => 'FusionAuthPatchUserConsentWithId',
  'method' => 'PATCH',
  'path' => '/api/user/consent/{userConsentId}',
  'operation_id' => 'patchUserConsentWithId',
  'summary' => 'patch User Consent With Id',
  'description' => 'Updates, via PATCH, a single User consent by Id.',
  'parameters' =>
  array (
    'user_consent_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The User Consent Id',
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
    'userConsentId' => 'user_consent_id',
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
