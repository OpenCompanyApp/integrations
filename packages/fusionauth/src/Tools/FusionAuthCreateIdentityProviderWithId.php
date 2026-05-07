<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Identity Provider With Id.
 *
 * Maps to POST /api/identity-provider/{identityProviderId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateIdentityProviderWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_identity_provider_with_id',
  'class' => 'FusionAuthCreateIdentityProviderWithId',
  'method' => 'POST',
  'path' => '/api/identity-provider/{identityProviderId}',
  'operation_id' => 'createIdentityProviderWithId',
  'summary' => 'create Identity Provider With Id',
  'description' => 'Creates an identity provider. You can optionally specify an Id for the identity provider, if not provided one will be generated.',
  'parameters' =>
  array (
    'identity_provider_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the identity provider. If not provided a secure random UUID will be generated.',
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
