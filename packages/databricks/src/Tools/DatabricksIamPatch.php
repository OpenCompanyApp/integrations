<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Patch.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/accounts/{account_id}/scim/v2/Groups/{id}.
 */
class DatabricksIamPatch extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_patch';
    protected const DESCRIPTION = 'Iam Patch

Official Databricks SDK endpoint: PATCH /api/2.0/accounts/{account_id}/scim/v2/Groups/{id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/accounts/{account_id}/scim/v2/Groups/{id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
}
