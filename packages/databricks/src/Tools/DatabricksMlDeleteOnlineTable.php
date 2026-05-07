<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Delete Online Table.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/feature-store/online-tables/{online_table_name}.
 */
class DatabricksMlDeleteOnlineTable extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_delete_online_table';
    protected const DESCRIPTION = 'Ml Delete Online Table

Official Databricks SDK endpoint: DELETE /api/2.0/feature-store/online-tables/{online_table_name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'online_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `online_table_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/feature-store/online-tables/{online_table_name}';
    protected const PATH_PARAMS = array (
  'online_table_name' => 'online_table_name',
);
}
