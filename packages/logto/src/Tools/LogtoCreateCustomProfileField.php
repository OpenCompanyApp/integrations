<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create a custom profile field.
 *
 * Maps to POST /api/custom-profile-fields in the official Logto OpenAPI source.
 */
class LogtoCreateCustomProfileField extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_custom_profile_field',
  'class' => 'LogtoCreateCustomProfileField',
  'method' => 'POST',
  'path' => '/api/custom-profile-fields',
  'operation_id' => 'CreateCustomProfileField',
  'summary' => 'Create a custom profile field',
  'description' => 'Create a custom profile field.',
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
