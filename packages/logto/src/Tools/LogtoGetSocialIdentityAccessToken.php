<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Retrieve the access token issued by a third-party social provider.
 *
 * Maps to GET /api/my-account/identities/{target}/access-token in the official Logto OpenAPI source.
 */
class LogtoGetSocialIdentityAccessToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_social_identity_access_token',
  'class' => 'LogtoGetSocialIdentityAccessToken',
  'method' => 'GET',
  'path' => '/api/my-account/identities/{target}/access-token',
  'operation_id' => 'GetSocialIdentityAccessToken',
  'summary' => 'Retrieve the access token issued by a third-party social provider',
  'description' => 'This API retrieves the access token issued by a third-party social provider for a given social target. Access is only available if token storage is enabled for the corresponding social connector. When a user authenticates through a social provider, Logto automatically stores the provider\'s tokens in an encrypted form. You can use this API to securely retrieve the stored access token and use it to access third-party APIs on behalf of the user.',
  'parameters' =>
  array (
    'target' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto path parameter `target`.',
    ),
  ),
  'path_params' =>
  array (
    'target' => 'target',
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
