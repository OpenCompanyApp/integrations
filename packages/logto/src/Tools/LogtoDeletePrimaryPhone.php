<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete primary phone.
 *
 * Maps to DELETE /api/my-account/primary-phone in the official Logto OpenAPI source.
 */
class LogtoDeletePrimaryPhone extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_primary_phone',
  'class' => 'LogtoDeletePrimaryPhone',
  'method' => 'DELETE',
  'path' => '/api/my-account/primary-phone',
  'operation_id' => 'DeletePrimaryPhone',
  'summary' => 'Delete primary phone',
  'description' => 'Delete primary phone for the user, a logto-verification-id header is required for checking sensitive permissions. The request is rejected if it would remove the user\'s last identifier.',
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
