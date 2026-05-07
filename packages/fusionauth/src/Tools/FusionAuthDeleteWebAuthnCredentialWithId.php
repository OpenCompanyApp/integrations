<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Web Authn Credential With Id.
 *
 * Maps to DELETE /api/webauthn/{id} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteWebAuthnCredentialWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_web_authn_credential_with_id',
  'class' => 'FusionAuthDeleteWebAuthnCredentialWithId',
  'method' => 'DELETE',
  'path' => '/api/webauthn/{id}',
  'operation_id' => 'deleteWebAuthnCredentialWithId',
  'summary' => 'delete Web Authn Credential With Id',
  'description' => 'Deletes the WebAuthn credential for the given Id.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the WebAuthn credential to delete.',
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
  'type' => 'write',
);
}
