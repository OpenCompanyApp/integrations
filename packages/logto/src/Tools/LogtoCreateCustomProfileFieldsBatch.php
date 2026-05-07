<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Batch create custom profile fields.
 *
 * Maps to POST /api/custom-profile-fields/batch in the official Logto OpenAPI source.
 */
class LogtoCreateCustomProfileFieldsBatch extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_custom_profile_fields_batch',
  'class' => 'LogtoCreateCustomProfileFieldsBatch',
  'method' => 'POST',
  'path' => '/api/custom-profile-fields/batch',
  'operation_id' => 'CreateCustomProfileFieldsBatch',
  'summary' => 'Batch create custom profile fields',
  'description' => 'Create multiple custom profile fields in a single request (max 20 items).',
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
