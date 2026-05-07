<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Retrieve the access token issued by a third-party enterprise SSO provider.
 *
 * Maps to GET /api/my-account/sso-identities/{connectorId}/access-token in the official Logto OpenAPI source.
 */
class LogtoGetEnterpriseSsoIdentityAccessToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_enterprise_sso_identity_access_token',
  'class' => 'LogtoGetEnterpriseSsoIdentityAccessToken',
  'method' => 'GET',
  'path' => '/api/my-account/sso-identities/{connectorId}/access-token',
  'operation_id' => 'GetEnterpriseSsoIdentityAccessToken',
  'summary' => 'Retrieve the access token issued by a third-party enterprise SSO provider',
  'description' => 'This API retrieves the access token issued by a third-party enterprise SSO provider for a given SSO connector ID. Access is only available if token storage is enabled for the corresponding connector. When a user authenticates through a SSO provider, Logto automatically stores the provider\'s tokens in an encrypted form. You can use this API to securely retrieve the stored access token and use it to access third-party APIs on behalf of the user.',
  'parameters' =>
  array (
    'connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the connector.',
    ),
  ),
  'path_params' =>
  array (
    'connectorId' => 'connector_id',
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
