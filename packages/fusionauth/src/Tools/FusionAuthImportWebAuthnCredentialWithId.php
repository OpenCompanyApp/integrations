<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * import Web Authn Credential With Id.
 *
 * Maps to POST /api/webauthn/import in the official FusionAuth OpenAPI document.
 */
class FusionAuthImportWebAuthnCredentialWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_import_web_authn_credential_with_id',
  'class' => 'FusionAuthImportWebAuthnCredentialWithId',
  'method' => 'POST',
  'path' => '/api/webauthn/import',
  'operation_id' => 'importWebAuthnCredentialWithId',
  'summary' => 'import Web Authn Credential With Id',
  'description' => 'Import a WebAuthn credential',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
