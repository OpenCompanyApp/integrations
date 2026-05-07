<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * verify Identity With Id.
 *
 * Maps to POST /api/identity/verify in the official FusionAuth OpenAPI document.
 */
class FusionAuthVerifyIdentityWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_verify_identity_with_id',
  'class' => 'FusionAuthVerifyIdentityWithId',
  'method' => 'POST',
  'path' => '/api/identity/verify',
  'operation_id' => 'verifyIdentityWithId',
  'summary' => 'verify Identity With Id',
  'description' => 'Administratively verify a user identity.',
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
