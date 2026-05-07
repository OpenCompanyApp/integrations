<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Oauth2 Create.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/accounts/{account_id}/oauth2/published-app-integrations.
 */
class DatabricksOauth2Create3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_oauth2_create_3';
    protected const DESCRIPTION = 'Oauth2 Create

Official Databricks SDK endpoint: POST /api/2.0/accounts/{account_id}/oauth2/published-app-integrations

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
    protected const PATH = '/api/2.0/accounts/{account_id}/oauth2/published-app-integrations';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
}
