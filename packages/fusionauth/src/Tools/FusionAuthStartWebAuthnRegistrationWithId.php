<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * start Web Authn Registration With Id.
 *
 * Maps to POST /api/webauthn/register/start in the official FusionAuth OpenAPI document.
 */
class FusionAuthStartWebAuthnRegistrationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_start_web_authn_registration_with_id',
  'class' => 'FusionAuthStartWebAuthnRegistrationWithId',
  'method' => 'POST',
  'path' => '/api/webauthn/register/start',
  'operation_id' => 'startWebAuthnRegistrationWithId',
  'summary' => 'start Web Authn Registration With Id',
  'description' => 'Start a WebAuthn registration ceremony by generating a new challenge for the user',
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
