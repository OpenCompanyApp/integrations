<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List Hybrid Deployment Agents.
 *
 * Maps to the official Fivetran endpoint get /v1/hybrid-deployment-agents.
 */
class FivetranGetHybridDeploymentAgentList extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_hybrid_deployment_agent_list';
    protected const DESCRIPTION = 'List Hybrid Deployment Agents

Official Fivetran endpoint: GET /v1/hybrid-deployment-agents

Returns list of all Hybrid Deployment Agents within your Fivetran account, along with usage. Optionally filtered to a single group.';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `groupId` from the official Fivetran API operation. The Fivetran Group Id.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Fivetran API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Fivetran API operation.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/hybrid-deployment-agents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'groupId' => 'group_id',
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
