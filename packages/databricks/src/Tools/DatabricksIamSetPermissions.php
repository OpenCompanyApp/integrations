<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Set Permissions.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/permissions/authorization/passwords.
 */
class DatabricksIamSetPermissions extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_set_permissions';
    protected const DESCRIPTION = 'Iam Set Permissions

Official Databricks SDK endpoint: PUT /api/2.0/permissions/authorization/passwords

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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/permissions/authorization/passwords';
    protected const PATH_PARAMS = array (
);
}
