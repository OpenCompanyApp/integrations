<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Identity Provider Link.
 *
 * Maps to GET /api/identity-provider/link in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveIdentityProviderLink extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_identity_provider_link',
  'class' => 'FusionAuthRetrieveIdentityProviderLink',
  'method' => 'GET',
  'path' => '/api/identity-provider/link',
  'operation_id' => 'retrieveIdentityProviderLink',
  'summary' => 'retrieve Identity Provider Link',
  'description' => 'Retrieve all Identity Provider users (links) for the user. Specify the optional identityProviderId to retrieve links for a particular IdP. OR Retrieve a single Identity Provider user (link).',
  'parameters' =>
  array (
    'identity_provider_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the identity provider. Specify this value to reduce the links returned to those for a particular IdP.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the user.',
    ),
    'identity_provider_user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the user in the 3rd party identity provider.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'identityProviderId' => 'identity_provider_id',
    'userId' => 'user_id',
    'identityProviderUserId' => 'identity_provider_user_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
