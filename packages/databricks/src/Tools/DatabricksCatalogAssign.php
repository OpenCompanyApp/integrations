<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Assign.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.1/unity-catalog/workspaces/{workspace_id}/metastore.
 */
class DatabricksCatalogAssign extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_assign';
    protected const DESCRIPTION = 'Catalog Assign

Official Databricks SDK endpoint: PUT /api/2.1/unity-catalog/workspaces/{workspace_id}/metastore

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'workspace_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `workspace_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/workspaces/{workspace_id}/metastore';
    protected const PATH_PARAMS = array (
  'workspace_id' => 'workspace_id',
);
}
