<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete User Link With Id.
 *
 * Maps to DELETE /api/identity-provider/link in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteUserLinkWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_user_link_with_id',
  'class' => 'FusionAuthDeleteUserLinkWithId',
  'method' => 'DELETE',
  'path' => '/api/identity-provider/link',
  'operation_id' => 'deleteUserLinkWithId',
  'summary' => 'delete User Link With Id',
  'description' => 'Remove an existing link that has been made from a 3rd party identity provider to a FusionAuth user.',
  'parameters' =>
  array (
    'identity_provider_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the identity provider.',
    ),
    'identity_provider_user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the user in the 3rd party identity provider to unlink.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the FusionAuth user to unlink.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'identityProviderId' => 'identity_provider_id',
    'identityProviderUserId' => 'identity_provider_user_id',
    'userId' => 'user_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
