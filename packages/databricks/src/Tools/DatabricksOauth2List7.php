<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Oauth2 List.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/accounts/servicePrincipals/{service_principal_id}/credentials/secrets.
 */
class DatabricksOauth2List7 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_oauth2_list_7';
    protected const DESCRIPTION = 'Oauth2 List

Official Databricks SDK endpoint: GET /api/2.0/accounts/servicePrincipals/{service_principal_id}/credentials/secrets

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'service_principal_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `service_principal_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/servicePrincipals/{service_principal_id}/credentials/secrets';
    protected const PATH_PARAMS = array (
  'service_principal_id' => 'service_principal_id',
);
}
