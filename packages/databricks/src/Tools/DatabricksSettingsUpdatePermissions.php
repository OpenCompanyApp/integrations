<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Update Permissions.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/permissions/authorization/tokens.
 */
class DatabricksSettingsUpdatePermissions extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_update_permissions';
    protected const DESCRIPTION = 'Settings Update Permissions

Official Databricks SDK endpoint: PATCH /api/2.0/permissions/authorization/tokens

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/permissions/authorization/tokens';
    protected const PATH_PARAMS = array (
);
}
