<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Oauth2 Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/accounts/{account_id}/servicePrincipals/{service_principal_id}/federationPolicies/{policy_id}.
 */
class DatabricksOauth2Delete4 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_oauth2_delete_4';
    protected const DESCRIPTION = 'Oauth2 Delete

Official Databricks SDK endpoint: DELETE /api/2.0/accounts/{account_id}/servicePrincipals/{service_principal_id}/federationPolicies/{policy_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'service_principal_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `service_principal_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/accounts/{account_id}/servicePrincipals/{service_principal_id}/federationPolicies/{policy_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'service_principal_id' => 'service_principal_id',
  'policy_id' => 'policy_id',
);
}
