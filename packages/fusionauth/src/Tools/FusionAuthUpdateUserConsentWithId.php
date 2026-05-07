<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update User Consent With Id.
 *
 * Maps to PUT /api/user/consent/{userConsentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateUserConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_user_consent_with_id',
  'class' => 'FusionAuthUpdateUserConsentWithId',
  'method' => 'PUT',
  'path' => '/api/user/consent/{userConsentId}',
  'operation_id' => 'updateUserConsentWithId',
  'summary' => 'update User Consent With Id',
  'description' => 'Updates a single User consent by Id.',
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
