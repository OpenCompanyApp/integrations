<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete primary email.
 *
 * Maps to DELETE /api/my-account/primary-email in the official Logto OpenAPI source.
 */
class LogtoDeletePrimaryEmail extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_primary_email',
  'class' => 'LogtoDeletePrimaryEmail',
  'method' => 'DELETE',
  'path' => '/api/my-account/primary-email',
  'operation_id' => 'DeletePrimaryEmail',
  'summary' => 'Delete primary email',
  'description' => 'Delete primary email for the user, a logto-verification-id header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
  'parameters' =>
  array (
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
