<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * complete Web Authn Login With Id.
 *
 * Maps to POST /api/webauthn/login in the official FusionAuth OpenAPI document.
 */
class FusionAuthCompleteWebAuthnLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_complete_web_authn_login_with_id',
  'class' => 'FusionAuthCompleteWebAuthnLoginWithId',
  'method' => 'POST',
  'path' => '/api/webauthn/login',
  'operation_id' => 'completeWebAuthnLoginWithId',
  'summary' => 'complete Web Authn Login With Id',
  'description' => 'Complete a WebAuthn authentication ceremony by validating the signature against the previously generated challenge and then login the user in',
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
