<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Vectorsearch Query Next Page.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/vector-search/indexes/{index_name}/query-next-page.
 */
class DatabricksVectorsearchQueryNextPage extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_vectorsearch_query_next_page';
    protected const DESCRIPTION = 'Vectorsearch Query Next Page

Official Databricks SDK endpoint: POST /api/2.0/vector-search/indexes/{index_name}/query-next-page

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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/vector-search/indexes/{index_name}/query-next-page';
    protected const PATH_PARAMS = array (
  'index_name' => 'index_name',
);
}
