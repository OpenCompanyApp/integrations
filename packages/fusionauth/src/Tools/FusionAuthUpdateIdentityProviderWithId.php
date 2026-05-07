<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Identity Provider With Id.
 *
 * Maps to PUT /api/identity-provider/{identityProviderId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateIdentityProviderWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_identity_provider_with_id',
  'class' => 'FusionAuthUpdateIdentityProviderWithId',
  'method' => 'PUT',
  'path' => '/api/identity-provider/{identityProviderId}',
  'operation_id' => 'updateIdentityProviderWithId',
  'summary' => 'update Identity Provider With Id',
  'description' => 'Updates the identity provider with the given Id.',
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
