<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Billing Update.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.1/accounts/{account_id}/budgets/{budget_id}.
 */
class DatabricksBillingUpdate2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_billing_update_2';
    protected const DESCRIPTION = 'Billing Update

Official Databricks SDK endpoint: PUT /api/2.1/accounts/{account_id}/budgets/{budget_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'budget_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `budget_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.1/accounts/{account_id}/budgets/{budget_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'budget_id' => 'budget_id',
);
}
