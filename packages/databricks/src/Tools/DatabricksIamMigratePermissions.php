<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Migrate Permissions.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/permissionmigration.
 */
class DatabricksIamMigratePermissions extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_migrate_permissions';
    protected const DESCRIPTION = 'Iam Migrate Permissions

Official Databricks SDK endpoint: POST /api/2.0/permissionmigration

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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/permissionmigration';
    protected const PATH_PARAMS = array (
);
}
