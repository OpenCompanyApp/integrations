<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Provisioning Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/accounts/{account_id}/private-access-settings/{private_access_settings_id}.
 */
class DatabricksProvisioningDelete4 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_provisioning_delete_4';
    protected const DESCRIPTION = 'Provisioning Delete

Official Databricks SDK endpoint: DELETE /api/2.0/accounts/{account_id}/private-access-settings/{private_access_settings_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'private_access_settings_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `private_access_settings_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/private-access-settings/{private_access_settings_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'private_access_settings_id' => 'private_access_settings_id',
);
}
