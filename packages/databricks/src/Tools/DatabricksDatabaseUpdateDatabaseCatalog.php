<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Database Update Database Catalog.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/database/catalogs/{name}.
 */
class DatabricksDatabaseUpdateDatabaseCatalog extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_database_update_database_catalog';
    protected const DESCRIPTION = 'Database Update Database Catalog

Official Databricks SDK endpoint: PATCH /api/2.0/database/catalogs/{name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/database/catalogs/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
