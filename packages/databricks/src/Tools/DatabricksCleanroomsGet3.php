<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Cleanrooms Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/clean-rooms/{clean_room_name}/auto-approval-rules/{rule_id}.
 */
class DatabricksCleanroomsGet3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_cleanrooms_get_3';
    protected const DESCRIPTION = 'Cleanrooms Get

Official Databricks SDK endpoint: GET /api/2.0/clean-rooms/{clean_room_name}/auto-approval-rules/{rule_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'clean_room_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `clean_room_name` from the Databricks SDK endpoint.',
  ),
  'rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `rule_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/clean-rooms/{clean_room_name}/auto-approval-rules/{rule_id}';
    protected const PATH_PARAMS = array (
  'clean_room_name' => 'clean_room_name',
  'rule_id' => 'rule_id',
);
}
