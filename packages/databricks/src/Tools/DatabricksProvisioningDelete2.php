<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Provisioning Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/accounts/{account_id}/customer-managed-keys/{customer_managed_key_id}.
 */
class DatabricksProvisioningDelete2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_provisioning_delete_2';
    protected const DESCRIPTION = 'Provisioning Delete

Official Databricks SDK endpoint: DELETE /api/2.0/accounts/{account_id}/customer-managed-keys/{customer_managed_key_id}

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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/accounts/{account_id}/customer-managed-keys/{customer_managed_key_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'customer_managed_key_id' => 'customer_managed_key_id',
);
}
