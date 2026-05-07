<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * complete Verify Identity With Id.
 *
 * Maps to POST /api/identity/verify/complete in the official FusionAuth OpenAPI document.
 */
class FusionAuthCompleteVerifyIdentityWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_complete_verify_identity_with_id',
  'class' => 'FusionAuthCompleteVerifyIdentityWithId',
  'method' => 'POST',
  'path' => '/api/identity/verify/complete',
  'operation_id' => 'completeVerifyIdentityWithId',
  'summary' => 'complete Verify Identity With Id',
  'description' => 'Completes verification of an identity using verification codes from the Verify Start API.',
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
