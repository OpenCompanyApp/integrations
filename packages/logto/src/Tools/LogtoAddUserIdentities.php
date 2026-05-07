<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add a user identity.
 *
 * Maps to POST /api/my-account/identities in the official Logto OpenAPI source.
 */
class LogtoAddUserIdentities extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_add_user_identities',
  'class' => 'LogtoAddUserIdentities',
  'method' => 'POST',
  'path' => '/api/my-account/identities',
  'operation_id' => 'AddUserIdentities',
  'summary' => 'Add a user identity',
  'description' => 'Add an identity (social identity) to the user, a logto-verification-id in header is required for checking sensitive permissions, and a verification record for the social identity is required.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
