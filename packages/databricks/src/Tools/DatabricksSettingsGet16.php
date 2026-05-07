<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/ip-access-lists/{ip_access_list_id}.
 */
class DatabricksSettingsGet16 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_get_16';
    protected const DESCRIPTION = 'Settings Get

Official Databricks SDK endpoint: GET /api/2.0/ip-access-lists/{ip_access_list_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'ip_access_list_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ip_access_list_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/ip-access-lists/{ip_access_list_id}';
    protected const PATH_PARAMS = array (
  'ip_access_list_id' => 'ip_access_list_id',
);
}
