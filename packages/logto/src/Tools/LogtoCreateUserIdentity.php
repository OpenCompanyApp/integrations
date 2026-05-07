<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Link social identity to user.
 *
 * Maps to POST /api/users/{userId}/identities in the official Logto OpenAPI source.
 */
class LogtoCreateUserIdentity extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_user_identity',
  'class' => 'LogtoCreateUserIdentity',
  'method' => 'POST',
  'path' => '/api/users/{userId}/identities',
  'operation_id' => 'CreateUserIdentity',
  'summary' => 'Link social identity to user',
  'description' => 'Link authenticated user identity from a social platform to a Logto user. The usage of this API is usually coupled with `POST /connectors/:connectorId/authorization-uri`. With the help of these pair of APIs, you can implement a user profile page with the link social account feature in your application. Note: Currently due to technical limitations, this API does not support the following connectors that rely on Logto interaction session: `@logto/connector-apple`, `@logto/connector-saml`, `@logto/c',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
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
    'userId' => 'user_id',
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
