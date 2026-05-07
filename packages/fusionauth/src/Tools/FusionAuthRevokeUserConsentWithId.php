<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * revoke User Consent With Id.
 *
 * Maps to DELETE /api/user/consent/{userConsentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRevokeUserConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_revoke_user_consent_with_id',
  'class' => 'FusionAuthRevokeUserConsentWithId',
  'method' => 'DELETE',
  'path' => '/api/user/consent/{userConsentId}',
  'operation_id' => 'revokeUserConsentWithId',
  'summary' => 'revoke User Consent With Id',
  'description' => 'Revokes a single User consent by Id.',
  'parameters' =>
  array (
    'user_consent_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The User Consent Id',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
