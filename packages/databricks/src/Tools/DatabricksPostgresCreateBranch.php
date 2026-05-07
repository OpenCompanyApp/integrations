<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Postgres Create Branch.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/postgres/{parent}/branches.
 */
class DatabricksPostgresCreateBranch extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_postgres_create_branch';
    protected const DESCRIPTION = 'Postgres Create Branch

Official Databricks SDK endpoint: POST /api/2.0/postgres/{parent}/branches

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/postgres/{parent}/branches';
    protected const PATH_PARAMS = array (
  'parent' => 'parent',
);
}
