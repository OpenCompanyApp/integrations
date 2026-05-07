<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sql Get Statement Result Chunk N.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/sql/statements/{statement_id}/result/chunks/{chunk_index}.
 */
class DatabricksSqlGetStatementResultChunkN extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sql_get_statement_result_chunk_n';
    protected const DESCRIPTION = 'Sql Get Statement Result Chunk N

Official Databricks SDK endpoint: GET /api/2.0/sql/statements/{statement_id}/result/chunks/{chunk_index}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'statement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `statement_id` from the Databricks SDK endpoint.',
  ),
  'chunk_index' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `chunk_index` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/sql/statements/{statement_id}/result/chunks/{chunk_index}';
    protected const PATH_PARAMS = array (
  'statement_id' => 'statement_id',
  'chunk_index' => 'chunk_index',
);
}
