<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Web Authn Credentials For User With Id.
 *
 * Maps to DELETE /api/webauthn in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteWebAuthnCredentialsForUserWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_web_authn_credentials_for_user_with_id',
  'class' => 'FusionAuthDeleteWebAuthnCredentialsForUserWithId',
  'method' => 'DELETE',
  'path' => '/api/webauthn',
  'operation_id' => 'deleteWebAuthnCredentialsForUserWithId',
  'summary' => 'delete Web Authn Credentials For User With Id',
  'description' => 'Deletes all of the WebAuthn credentials for the given User Id.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the User to delete WebAuthn passkeys for.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
