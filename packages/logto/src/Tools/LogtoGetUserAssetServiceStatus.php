<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get service status.
 *
 * Maps to GET /api/user-assets/service-status in the official Logto OpenAPI source.
 */
class LogtoGetUserAssetServiceStatus extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_user_asset_service_status',
  'class' => 'LogtoGetUserAssetServiceStatus',
  'method' => 'GET',
  'path' => '/api/user-assets/service-status',
  'operation_id' => 'GetUserAssetServiceStatus',
  'summary' => 'Get service status',
  'description' => 'Get user assets service status.',
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
