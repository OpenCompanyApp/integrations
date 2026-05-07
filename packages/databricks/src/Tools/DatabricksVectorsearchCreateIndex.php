<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Vectorsearch Create Index.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/vector-search/indexes.
 */
class DatabricksVectorsearchCreateIndex extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_vectorsearch_create_index';
    protected const DESCRIPTION = 'Vectorsearch Create Index

Official Databricks SDK endpoint: POST /api/2.0/vector-search/indexes

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
    protected const PATH = '/api/2.0/vector-search/indexes';
    protected const PATH_PARAMS = array (
);
}
