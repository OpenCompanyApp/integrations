<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * complete Web Authn Registration With Id.
 *
 * Maps to POST /api/webauthn/register/complete in the official FusionAuth OpenAPI document.
 */
class FusionAuthCompleteWebAuthnRegistrationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_complete_web_authn_registration_with_id',
  'class' => 'FusionAuthCompleteWebAuthnRegistrationWithId',
  'method' => 'POST',
  'path' => '/api/webauthn/register/complete',
  'operation_id' => 'completeWebAuthnRegistrationWithId',
  'summary' => 'complete Web Authn Registration With Id',
  'description' => 'Complete a WebAuthn registration ceremony by validating the client request and saving the new credential',
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
