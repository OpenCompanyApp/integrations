<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Provisioning Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/accounts/{account_id}/customer-managed-keys/{customer_managed_key_id}.
 */
class DatabricksProvisioningGet2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_provisioning_get_2';
    protected const DESCRIPTION = 'Provisioning Get

Official Databricks SDK endpoint: GET /api/2.0/accounts/{account_id}/customer-managed-keys/{customer_managed_key_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'customer_managed_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer_managed_key_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/customer-managed-keys/{customer_managed_key_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'customer_managed_key_id' => 'customer_managed_key_id',
);
}
