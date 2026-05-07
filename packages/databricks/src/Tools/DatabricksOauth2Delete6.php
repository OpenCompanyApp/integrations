<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Oauth2 Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/accounts/servicePrincipals/{service_principal_id}/credentials/secrets/{secret_id}.
 */
class DatabricksOauth2Delete6 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_oauth2_delete_6';
    protected const DESCRIPTION = 'Oauth2 Delete

Official Databricks SDK endpoint: DELETE /api/2.0/accounts/servicePrincipals/{service_principal_id}/credentials/secrets/{secret_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'service_principal_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `service_principal_id` from the Databricks SDK endpoint.',
  ),
  'secret_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `secret_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/servicePrincipals/{service_principal_id}/credentials/secrets/{secret_id}';
    protected const PATH_PARAMS = array (
  'service_principal_id' => 'service_principal_id',
  'secret_id' => 'secret_id',
);
}
