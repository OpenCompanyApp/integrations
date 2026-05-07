<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Upload custom UI assets.
 *
 * Maps to POST /api/sign-in-exp/default/custom-ui-assets in the official Logto OpenAPI source.
 */
class LogtoUploadCustomUiAssets extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_upload_custom_ui_assets',
  'class' => 'LogtoUploadCustomUiAssets',
  'method' => 'POST',
  'path' => '/api/sign-in-exp/default/custom-ui-assets',
  'operation_id' => 'UploadCustomUiAssets',
  'summary' => 'Upload custom UI assets',
  'description' => 'Upload a zip file containing custom web assets such as HTML, CSS, and JavaScript files, then replace the default sign-in experience with the custom UI assets.',
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
