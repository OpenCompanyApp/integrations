<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Oauth2 Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/accounts/{account_id}/federationPolicies/{policy_id}.
 */
class DatabricksOauth2Get extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_oauth2_get';
    protected const DESCRIPTION = 'Oauth2 Get

Official Databricks SDK endpoint: GET /api/2.0/accounts/{account_id}/federationPolicies/{policy_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'policy_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policy_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/federationPolicies/{policy_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'policy_id' => 'policy_id',
);
}
