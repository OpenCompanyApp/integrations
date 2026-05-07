<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update primary email.
 *
 * Maps to POST /api/my-account/primary-email in the official Logto OpenAPI source.
 */
class LogtoUpdatePrimaryEmail extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_primary_email',
  'class' => 'LogtoUpdatePrimaryEmail',
  'method' => 'POST',
  'path' => '/api/my-account/primary-email',
  'operation_id' => 'UpdatePrimaryEmail',
  'summary' => 'Update primary email',
  'description' => 'Update primary email for the user, a logto-verification-id in header is required for checking sensitive permissions, and a new identifier verification record is required for the new email ownership verification.',
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
