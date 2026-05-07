<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Web Authn Credential With Id.
 *
 * Maps to GET /api/webauthn/{id} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveWebAuthnCredentialWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_web_authn_credential_with_id',
  'class' => 'FusionAuthRetrieveWebAuthnCredentialWithId',
  'method' => 'GET',
  'path' => '/api/webauthn/{id}',
  'operation_id' => 'retrieveWebAuthnCredentialWithId',
  'summary' => 'retrieve Web Authn Credential With Id',
  'description' => 'Retrieves the WebAuthn credential for the given Id.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the WebAuthn credential.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
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
