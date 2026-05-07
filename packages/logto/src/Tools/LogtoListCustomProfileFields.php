<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get all custom profile fields.
 *
 * Maps to GET /api/custom-profile-fields in the official Logto OpenAPI source.
 */
class LogtoListCustomProfileFields extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_custom_profile_fields',
  'class' => 'LogtoListCustomProfileFields',
  'method' => 'GET',
  'path' => '/api/custom-profile-fields',
  'operation_id' => 'ListCustomProfileFields',
  'summary' => 'Get all custom profile fields',
  'description' => 'Get all custom profile fields.',
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
  'type' => 'read',
);
}
