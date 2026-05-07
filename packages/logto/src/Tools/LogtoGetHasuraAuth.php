<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Hasura auth hook endpoint.
 *
 * Maps to GET /api/authn/hasura in the official Logto OpenAPI source.
 */
class LogtoGetHasuraAuth extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_hasura_auth',
  'class' => 'LogtoGetHasuraAuth',
  'method' => 'GET',
  'path' => '/api/authn/hasura',
  'operation_id' => 'GetHasuraAuth',
  'summary' => 'Hasura auth hook endpoint',
  'description' => 'The `HASURA_GRAPHQL_AUTH_HOOK` endpoint for Hasura auth. Use this endpoint to integrate Hasura\'s [webhook authentication flow](https://hasura.io/docs/latest/auth/authentication/webhook/).',
  'parameters' =>
  array (
    'resource' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto query parameter `resource`.',
    ),
    'unauthorized_role' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `unauthorizedRole`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'resource' => 'resource',
    'unauthorizedRole' => 'unauthorized_role',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
