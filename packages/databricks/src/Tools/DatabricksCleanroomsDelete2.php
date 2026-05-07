<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Cleanrooms Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/clean-rooms/{clean_room_name}/auto-approval-rules/{rule_id}.
 */
class DatabricksCleanroomsDelete2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_cleanrooms_delete_2';
    protected const DESCRIPTION = 'Cleanrooms Delete

Official Databricks SDK endpoint: DELETE /api/2.0/clean-rooms/{clean_room_name}/auto-approval-rules/{rule_id}

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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/clean-rooms/{clean_room_name}/auto-approval-rules/{rule_id}';
    protected const PATH_PARAMS = array (
  'clean_room_name' => 'clean_room_name',
  'rule_id' => 'rule_id',
);
}
