<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update primary phone.
 *
 * Maps to POST /api/my-account/primary-phone in the official Logto OpenAPI source.
 */
class LogtoUpdatePrimaryPhone extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_primary_phone',
  'class' => 'LogtoUpdatePrimaryPhone',
  'method' => 'POST',
  'path' => '/api/my-account/primary-phone',
  'operation_id' => 'UpdatePrimaryPhone',
  'summary' => 'Update primary phone',
  'description' => 'Update primary phone for the user, a logto-verification-id in header is required for checking sensitive permissions, and a new identifier verification record is required for the new phone ownership verification.',
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
