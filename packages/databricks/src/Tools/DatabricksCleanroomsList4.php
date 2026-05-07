<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Cleanrooms List.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/clean-rooms/{clean_room_name}/runs.
 */
class DatabricksCleanroomsList4 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_cleanrooms_list_4';
    protected const DESCRIPTION = 'Cleanrooms List

Official Databricks SDK endpoint: GET /api/2.0/clean-rooms/{clean_room_name}/runs

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'clean_room_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `clean_room_name` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/clean-rooms/{clean_room_name}/runs';
    protected const PATH_PARAMS = array (
  'clean_room_name' => 'clean_room_name',
);
}
