<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Identity Provider By Type With Id.
 *
 * Maps to GET /api/identity-provider in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveIdentityProviderByTypeWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_identity_provider_by_type_with_id',
  'class' => 'FusionAuthRetrieveIdentityProviderByTypeWithId',
  'method' => 'GET',
  'path' => '/api/identity-provider',
  'operation_id' => 'retrieveIdentityProviderByTypeWithId',
  'summary' => 'retrieve Identity Provider By Type With Id',
  'description' => 'Retrieves one or more identity provider for the given type. For types such as Google, Facebook, Twitter and LinkedIn, only a single identity provider can exist. For types such as OpenID Connect and SAMLv2 more than one identity provider can be configured so this request may return multiple identity providers.',
  'parameters' =>
  array (
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The type of the identity provider.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'type' => 'type',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
