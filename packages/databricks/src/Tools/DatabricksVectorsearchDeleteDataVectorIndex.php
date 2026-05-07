<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Vectorsearch Delete Data Vector Index.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/vector-search/indexes/{index_name}/delete-data.
 */
class DatabricksVectorsearchDeleteDataVectorIndex extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_vectorsearch_delete_data_vector_index';
    protected const DESCRIPTION = 'Vectorsearch Delete Data Vector Index

Official Databricks SDK endpoint: DELETE /api/2.0/vector-search/indexes/{index_name}/delete-data

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
    protected const PATH = '/api/2.0/vector-search/indexes/{index_name}/delete-data';
    protected const PATH_PARAMS = array (
  'index_name' => 'index_name',
);
}
