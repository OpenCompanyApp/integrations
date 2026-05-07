<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Create.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/accounts/{account_id}/scim/v2/Users.
 */
class DatabricksIamCreate3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_create_3';
    protected const DESCRIPTION = 'Iam Create

Official Databricks SDK endpoint: POST /api/2.0/accounts/{account_id}/scim/v2/Users

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/accounts/{account_id}/scim/v2/Users';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
}
