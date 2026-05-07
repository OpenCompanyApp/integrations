<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Workspace Put Acl.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/secrets/acls/put.
 */
class DatabricksWorkspacePutAcl extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_workspace_put_acl';
    protected const DESCRIPTION = 'Workspace Put Acl

Official Databricks SDK endpoint: POST /api/2.0/secrets/acls/put

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
    protected const PATH = '/api/2.0/secrets/acls/put';
    protected const PATH_PARAMS = array (
);
}
