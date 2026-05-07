<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Billing Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/accounts/{account_id}/log-delivery/{log_delivery_configuration_id}.
 */
class DatabricksBillingGet3 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_billing_get_3';
    protected const DESCRIPTION = 'Billing Get

Official Databricks SDK endpoint: GET /api/2.0/accounts/{account_id}/log-delivery/{log_delivery_configuration_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'log_delivery_configuration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `log_delivery_configuration_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/log-delivery/{log_delivery_configuration_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'log_delivery_configuration_id' => 'log_delivery_configuration_id',
);
}
