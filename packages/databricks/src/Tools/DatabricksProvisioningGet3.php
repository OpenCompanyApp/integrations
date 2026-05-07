<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Provisioning Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/accounts/{account_id}/networks/{network_id}.
 */
class DatabricksProvisioningGet3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_provisioning_get_3';
    protected const DESCRIPTION = 'Provisioning Get

Official Databricks SDK endpoint: GET /api/2.0/accounts/{account_id}/networks/{network_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'network_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `network_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/networks/{network_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'network_id' => 'network_id',
);
}
