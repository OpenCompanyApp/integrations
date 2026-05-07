<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * start Verify Identity With Id.
 *
 * Maps to POST /api/identity/verify/start in the official FusionAuth OpenAPI document.
 */
class FusionAuthStartVerifyIdentityWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_start_verify_identity_with_id',
  'class' => 'FusionAuthStartVerifyIdentityWithId',
  'method' => 'POST',
  'path' => '/api/identity/verify/start',
  'operation_id' => 'startVerifyIdentityWithId',
  'summary' => 'start Verify Identity With Id',
  'description' => 'Start a verification of an identity by generating a code. This code can be sent to the User using the Verify Send API Verification Code API or using a mechanism outside of FusionAuth. The verification is completed by using the Verify Complete API with this code.',
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
