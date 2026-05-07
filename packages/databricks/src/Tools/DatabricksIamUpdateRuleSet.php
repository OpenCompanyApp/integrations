<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Update Rule Set.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/preview/accounts/{account_id}/access-control/rule-sets.
 */
class DatabricksIamUpdateRuleSet extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_update_rule_set';
    protected const DESCRIPTION = 'Iam Update Rule Set

Official Databricks SDK endpoint: PUT /api/2.0/preview/accounts/{account_id}/access-control/rule-sets

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
    protected const METHOD = 'put';
    protected const PATH = '/api/2.0/preview/accounts/{account_id}/access-control/rule-sets';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
}
