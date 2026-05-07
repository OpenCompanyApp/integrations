<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Provisioning Create.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/accounts/{account_id}/credentials.
 */
class DatabricksProvisioningCreate extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_provisioning_create';
    protected const DESCRIPTION = 'Provisioning Create

Official Databricks SDK endpoint: POST /api/2.0/accounts/{account_id}/credentials

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
    protected const PATH = '/api/2.0/accounts/{account_id}/credentials';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
}
