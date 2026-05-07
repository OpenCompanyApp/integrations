<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settingsv2 List Account User Preferences Metadata.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/accounts/{account_id}/users/{user_id}/settings-metadata.
 */
class DatabricksSettingsv2ListAccountUserPreferencesMetadata extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settingsv2_list_account_user_preferences_metadata';
    protected const DESCRIPTION = 'Settingsv2 List Account User Preferences Metadata

Official Databricks SDK endpoint: GET /api/2.1/accounts/{account_id}/users/{user_id}/settings-metadata

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/accounts/{account_id}/users/{user_id}/settings-metadata';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'user_id' => 'user_id',
);
}
