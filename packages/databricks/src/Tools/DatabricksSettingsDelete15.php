<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/settings/types/restrict_workspace_admins/names/default.
 */
class DatabricksSettingsDelete15 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_delete_15';
    protected const DESCRIPTION = 'Settings Delete

Official Databricks SDK endpoint: DELETE /api/2.0/settings/types/restrict_workspace_admins/names/default

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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/settings/types/restrict_workspace_admins/names/default';
    protected const PATH_PARAMS = array (
);
}
