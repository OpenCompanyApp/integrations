<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Replace.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/accounts/{account_id}/ip-access-lists/{ip_access_list_id}.
 */
class DatabricksSettingsReplace extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_replace';
    protected const DESCRIPTION = 'Settings Replace

Official Databricks SDK endpoint: PUT /api/2.0/accounts/{account_id}/ip-access-lists/{ip_access_list_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/accounts/{account_id}/ip-access-lists/{ip_access_list_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'ip_access_list_id' => 'ip_access_list_id',
);
}
