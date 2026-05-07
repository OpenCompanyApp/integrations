<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Vectorsearch Delete Index.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/vector-search/indexes/{index_name}.
 */
class DatabricksVectorsearchDeleteIndex extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_vectorsearch_delete_index';
    protected const DESCRIPTION = 'Vectorsearch Delete Index

Official Databricks SDK endpoint: DELETE /api/2.0/vector-search/indexes/{index_name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'index_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `index_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/vector-search/indexes/{index_name}';
    protected const PATH_PARAMS = array (
  'index_name' => 'index_name',
);
}
