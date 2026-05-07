<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Create Network Policy Rpc.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/accounts/{account_id}/network-policies.
 */
class DatabricksSettingsCreateNetworkPolicyRpc extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_create_network_policy_rpc';
    protected const DESCRIPTION = 'Settings Create Network Policy Rpc

Official Databricks SDK endpoint: POST /api/2.0/accounts/{account_id}/network-policies

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
    protected const PATH = '/api/2.0/accounts/{account_id}/network-policies';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
}
