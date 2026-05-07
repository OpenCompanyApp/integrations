<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Identity Provider With Id.
 *
 * Maps to PATCH /api/identity-provider/{identityProviderId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchIdentityProviderWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_identity_provider_with_id',
  'class' => 'FusionAuthPatchIdentityProviderWithId',
  'method' => 'PATCH',
  'path' => '/api/identity-provider/{identityProviderId}',
  'operation_id' => 'patchIdentityProviderWithId',
  'summary' => 'patch Identity Provider With Id',
  'description' => 'Updates, via PATCH, the identity provider with the given Id.',
  'parameters' =>
  array (
    'identity_provider_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the identity provider to update.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'identityProviderId' => 'identity_provider_id',
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
