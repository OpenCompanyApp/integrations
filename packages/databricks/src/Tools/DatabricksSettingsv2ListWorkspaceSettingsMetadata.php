<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settingsv2 List Workspace Settings Metadata.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/settings-metadata.
 */
class DatabricksSettingsv2ListWorkspaceSettingsMetadata extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settingsv2_list_workspace_settings_metadata';
    protected const DESCRIPTION = 'Settingsv2 List Workspace Settings Metadata

Official Databricks SDK endpoint: GET /api/2.1/settings-metadata

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.1/settings-metadata';
    protected const PATH_PARAMS = array (
);
}
