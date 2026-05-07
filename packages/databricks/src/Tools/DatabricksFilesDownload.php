<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Files Download.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/fs/files{file_path}.
 */
class DatabricksFilesDownload extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_files_download';
    protected const DESCRIPTION = 'Files Download

Official Databricks SDK endpoint: GET /api/2.0/fs/files{file_path}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'file_path' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `file_path` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/fs/files{file_path}';
    protected const PATH_PARAMS = array (
  'file_path' => 'file_path',
);
}
