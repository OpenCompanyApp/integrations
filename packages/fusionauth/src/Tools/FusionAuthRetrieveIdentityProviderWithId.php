<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Identity Provider With Id.
 *
 * Maps to GET /api/identity-provider/{identityProviderId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveIdentityProviderWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_identity_provider_with_id',
  'class' => 'FusionAuthRetrieveIdentityProviderWithId',
  'method' => 'GET',
  'path' => '/api/identity-provider/{identityProviderId}',
  'operation_id' => 'retrieveIdentityProviderWithId',
  'summary' => 'retrieve Identity Provider With Id',
  'description' => 'Retrieves the identity provider for the given Id or all the identity providers if the Id is null.',
  'parameters' =>
  array (
    'identity_provider_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The identity provider Id.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
