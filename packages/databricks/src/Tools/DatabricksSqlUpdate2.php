<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Update.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/preview/sql/alerts/{alert_id}.
 */
class DatabricksSqlUpdate2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_update_2';
    protected const DESCRIPTION = 'Sql Update

Official Databricks SDK endpoint: PUT /api/2.0/preview/sql/alerts/{alert_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'alert_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `alert_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/preview/sql/alerts/{alert_id}';
    protected const PATH_PARAMS = array (
  'alert_id' => 'alert_id',
);
}
