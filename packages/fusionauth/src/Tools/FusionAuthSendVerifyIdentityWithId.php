<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * send Verify Identity With Id.
 *
 * Maps to POST /api/identity/verify/send in the official FusionAuth OpenAPI document.
 */
class FusionAuthSendVerifyIdentityWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_send_verify_identity_with_id',
  'class' => 'FusionAuthSendVerifyIdentityWithId',
  'method' => 'POST',
  'path' => '/api/identity/verify/send',
  'operation_id' => 'sendVerifyIdentityWithId',
  'summary' => 'send Verify Identity With Id',
  'description' => 'Send a verification code using the appropriate transport for the identity type being verified.',
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
