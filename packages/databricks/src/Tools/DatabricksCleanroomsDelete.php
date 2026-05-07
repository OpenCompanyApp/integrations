<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Cleanrooms Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/clean-rooms/{clean_room_name}/assets/{asset_type}/{name}.
 */
class DatabricksCleanroomsDelete extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_cleanrooms_delete';
    protected const DESCRIPTION = 'Cleanrooms Delete

Official Databricks SDK endpoint: DELETE /api/2.0/clean-rooms/{clean_room_name}/assets/{asset_type}/{name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'clean_room_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `clean_room_name` from the Databricks SDK endpoint.',
  ),
  'asset_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `asset_type` from the Databricks SDK endpoint.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/clean-rooms/{clean_room_name}/assets/{asset_type}/{name}';
    protected const PATH_PARAMS = array (
  'clean_room_name' => 'clean_room_name',
  'asset_type' => 'asset_type',
  'name' => 'name',
);
}
