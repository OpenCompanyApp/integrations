<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Revoke a grant by ID.
 *
 * Maps to DELETE /api/my-account/grants/{grantId} in the official Logto OpenAPI source.
 */
class LogtoDeleteGrantById extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_grant_by_id',
  'class' => 'LogtoDeleteGrantById',
  'method' => 'DELETE',
  'path' => '/api/my-account/grants/{grantId}',
  'operation_id' => 'DeleteGrantById',
  'summary' => 'Revoke a grant by ID',
  'description' => 'Revoke a specific user application grant by grant ID and remove the related session authorization. A logto-verification-id in header is required for revoking grants.',
  'parameters' =>
  array (
    'grant_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the grant.',
    ),
  ),
  'path_params' =>
  array (
    'grantId' => 'grant_id',
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
