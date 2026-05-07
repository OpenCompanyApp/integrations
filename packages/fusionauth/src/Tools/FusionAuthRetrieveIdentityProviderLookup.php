<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Identity Provider Lookup.
 *
 * Maps to GET /api/identity-provider/lookup in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveIdentityProviderLookup extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_identity_provider_lookup',
  'class' => 'FusionAuthRetrieveIdentityProviderLookup',
  'method' => 'GET',
  'path' => '/api/identity-provider/lookup',
  'operation_id' => 'retrieveIdentityProviderLookup',
  'summary' => 'retrieve Identity Provider Lookup',
  'description' => 'Retrieves the identity provider for the given domain and tenantId. A 200 response code indicates the domain is managed by a registered identity provider. A 404 indicates the domain is not managed. OR Retrieves any global identity providers for the given domain. A 200 response code indicates the domain is managed by a registered identity provider. A 404 indicates the domain is not managed.',
  'parameters' =>
  array (
    'domain' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The domain or email address to lookup.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'If provided, the API searches for an identity provider scoped to the corresponding tenant that manages the requested domain. If no result is found, the API then searches for global identity providers.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'domain' => 'domain',
    'tenantId' => 'tenant_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
