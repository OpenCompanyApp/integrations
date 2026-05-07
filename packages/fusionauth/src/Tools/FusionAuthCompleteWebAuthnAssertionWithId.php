<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * complete Web Authn Assertion With Id.
 *
 * Maps to POST /api/webauthn/assert in the official FusionAuth OpenAPI document.
 */
class FusionAuthCompleteWebAuthnAssertionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_complete_web_authn_assertion_with_id',
  'class' => 'FusionAuthCompleteWebAuthnAssertionWithId',
  'method' => 'POST',
  'path' => '/api/webauthn/assert',
  'operation_id' => 'completeWebAuthnAssertionWithId',
  'summary' => 'complete Web Authn Assertion With Id',
  'description' => 'Complete a WebAuthn authentication ceremony by validating the signature against the previously generated challenge without logging the user in',
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
