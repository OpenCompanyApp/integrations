<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Identity Provider With Id.
 *
 * Maps to DELETE /api/identity-provider/{identityProviderId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteIdentityProviderWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_identity_provider_with_id',
  'class' => 'FusionAuthDeleteIdentityProviderWithId',
  'method' => 'DELETE',
  'path' => '/api/identity-provider/{identityProviderId}',
  'operation_id' => 'deleteIdentityProviderWithId',
  'summary' => 'delete Identity Provider With Id',
  'description' => 'Deletes the identity provider for the given Id.',
  'parameters' =>
  array (
    'identity_provider_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the identity provider to delete.',
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
  'type' => 'write',
);
}
