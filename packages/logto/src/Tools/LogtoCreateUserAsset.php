<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Upload asset.
 *
 * Maps to POST /api/user-assets in the official Logto OpenAPI source.
 */
class LogtoCreateUserAsset extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_user_asset',
  'class' => 'LogtoCreateUserAsset',
  'method' => 'POST',
  'path' => '/api/user-assets',
  'operation_id' => 'CreateUserAsset',
  'summary' => 'Upload asset',
  'description' => 'Upload a user asset.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
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
  'body_required' => false,
  'content_type' => 'multipart/form-data',
  'type' => 'write',
);
}
