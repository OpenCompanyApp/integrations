<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Files Delete Directory.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/fs/directories{directory_path}.
 */
class DatabricksFilesDeleteDirectory extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_files_delete_directory';
    protected const DESCRIPTION = 'Files Delete Directory

Official Databricks SDK endpoint: DELETE /api/2.0/fs/directories{directory_path}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'directory_path' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `directory_path` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/fs/directories{directory_path}';
    protected const PATH_PARAMS = array (
  'directory_path' => 'directory_path',
);
}
