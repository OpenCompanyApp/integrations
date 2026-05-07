<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Update Network Policy Rpc.
 *
 * Maps to the official Databricks SDK endpoint put /api/2.0/accounts/{account_id}/network-policies/{network_policy_id}.
 */
class DatabricksSettingsUpdateNetworkPolicyRpc extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_update_network_policy_rpc';
    protected const DESCRIPTION = 'Settings Update Network Policy Rpc

Official Databricks SDK endpoint: PUT /api/2.0/accounts/{account_id}/network-policies/{network_policy_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'network_policy_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `network_policy_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/network-policies/{network_policy_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'network_policy_id' => 'network_policy_id',
);
}
