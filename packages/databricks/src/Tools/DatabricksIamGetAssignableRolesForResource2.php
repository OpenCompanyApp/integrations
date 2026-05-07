<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Get Assignable Roles For Resource.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/preview/accounts/access-control/assignable-roles.
 */
class DatabricksIamGetAssignableRolesForResource2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_get_assignable_roles_for_resource_2';
    protected const DESCRIPTION = 'Iam Get Assignable Roles For Resource

Official Databricks SDK endpoint: GET /api/2.0/preview/accounts/access-control/assignable-roles

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/preview/accounts/access-control/assignable-roles';
    protected const PATH_PARAMS = array (
);
}
