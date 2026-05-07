<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Publish Table.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/feature-store/tables/{source_table_name}/publish.
 */
class DatabricksMlPublishTable extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_publish_table';
    protected const DESCRIPTION = 'Ml Publish Table

Official Databricks SDK endpoint: POST /api/2.0/feature-store/tables/{source_table_name}/publish

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'source_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `source_table_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/feature-store/tables/{source_table_name}/publish';
    protected const PATH_PARAMS = array (
  'source_table_name' => 'source_table_name',
);
}
