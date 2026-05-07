<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Update Alert.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/alerts/{id}.
 */
class DatabricksSqlUpdateAlert extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_update_alert';
    protected const DESCRIPTION = 'Sql Update Alert

Official Databricks SDK endpoint: PATCH /api/2.0/alerts/{id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/alerts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
}
