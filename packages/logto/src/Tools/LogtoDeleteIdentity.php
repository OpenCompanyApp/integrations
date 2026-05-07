<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete a user identity.
 *
 * Maps to DELETE /api/my-account/identities/{target} in the official Logto OpenAPI source.
 */
class LogtoDeleteIdentity extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_identity',
  'class' => 'LogtoDeleteIdentity',
  'method' => 'DELETE',
  'path' => '/api/my-account/identities/{target}',
  'operation_id' => 'DeleteIdentity',
  'summary' => 'Delete a user identity',
  'description' => 'Delete an identity (social identity) from the user, a logto-verification-id in header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
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
  'type' => 'write',
);
}
