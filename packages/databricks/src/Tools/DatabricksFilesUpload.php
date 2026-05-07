<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Files Upload.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/fs/files{file_path}.
 */
class DatabricksFilesUpload extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_files_upload';
    protected const DESCRIPTION = 'Files Upload

Official Databricks SDK endpoint: PUT /api/2.0/fs/files{file_path}

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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/fs/files{file_path}';
    protected const PATH_PARAMS = array (
  'file_path' => 'file_path',
);
}
