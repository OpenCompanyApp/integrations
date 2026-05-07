<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Delete Private Endpoint Rule.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/accounts/{account_id}/network-connectivity-configs/{network_connectivity_config_id}/private-endpoint-rules/{private_endpoint_rule_id}.
 */
class DatabricksSettingsDeletePrivateEndpointRule extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_delete_private_endpoint_rule';
    protected const DESCRIPTION = 'Settings Delete Private Endpoint Rule

Official Databricks SDK endpoint: DELETE /api/2.0/accounts/{account_id}/network-connectivity-configs/{network_connectivity_config_id}/private-endpoint-rules/{private_endpoint_rule_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
  'network_connectivity_config_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `network_connectivity_config_id` from the Databricks SDK endpoint.',
  ),
  'private_endpoint_rule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `private_endpoint_rule_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/accounts/{account_id}/network-connectivity-configs/{network_connectivity_config_id}/private-endpoint-rules/{private_endpoint_rule_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'network_connectivity_config_id' => 'network_connectivity_config_id',
  'private_endpoint_rule_id' => 'private_endpoint_rule_id',
);
}
