<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update the access token for a social identity by verification ID.
 *
 * Maps to PUT /api/my-account/identities/{target}/access-token in the official Logto OpenAPI source.
 */
class LogtoUpdateSocialIdentityAccessTokenByVerificationId extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_social_identity_access_token_by_verification_id',
  'class' => 'LogtoUpdateSocialIdentityAccessTokenByVerificationId',
  'method' => 'PUT',
  'path' => '/api/my-account/identities/{target}/access-token',
  'operation_id' => 'UpdateSocialIdentityAccessTokenByVerificationId',
  'summary' => 'Update the access token for a social identity by verification ID',
  'description' => 'This API updates the token storage for a social identity by a given social verification ID. It is used to fetch a new access token from the social provider and store it securely in Logto.',
  'parameters' =>
  array (
    'target' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto path parameter `target`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
