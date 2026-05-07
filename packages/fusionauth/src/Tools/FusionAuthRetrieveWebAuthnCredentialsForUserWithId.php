<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Web Authn Credentials For User With Id.
 *
 * Maps to GET /api/webauthn in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveWebAuthnCredentialsForUserWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_web_authn_credentials_for_user_with_id',
  'class' => 'FusionAuthRetrieveWebAuthnCredentialsForUserWithId',
  'method' => 'GET',
  'path' => '/api/webauthn',
  'operation_id' => 'retrieveWebAuthnCredentialsForUserWithId',
  'summary' => 'retrieve Web Authn Credentials For User With Id',
  'description' => 'Retrieves all WebAuthn credentials for the given user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The user\'s ID.',
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
  'type' => 'read',
);
}
