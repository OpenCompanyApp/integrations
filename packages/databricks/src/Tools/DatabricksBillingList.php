<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Billing List.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/accounts/{account_id}/budget-policies.
 */
class DatabricksBillingList extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_billing_list';
    protected const DESCRIPTION = 'Billing List

Official Databricks SDK endpoint: GET /api/2.1/accounts/{account_id}/budget-policies

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.1/accounts/{account_id}/budget-policies';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
}
