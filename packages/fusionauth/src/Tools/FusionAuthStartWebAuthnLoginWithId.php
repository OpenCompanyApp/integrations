<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * start Web Authn Login With Id.
 *
 * Maps to POST /api/webauthn/start in the official FusionAuth OpenAPI document.
 */
class FusionAuthStartWebAuthnLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_start_web_authn_login_with_id',
  'class' => 'FusionAuthStartWebAuthnLoginWithId',
  'method' => 'POST',
  'path' => '/api/webauthn/start',
  'operation_id' => 'startWebAuthnLoginWithId',
  'summary' => 'start Web Authn Login With Id',
  'description' => 'Start a WebAuthn authentication ceremony by generating a new challenge for the user',
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
