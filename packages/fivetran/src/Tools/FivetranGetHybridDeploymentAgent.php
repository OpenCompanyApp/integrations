<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Returns Hybrid Deployment Agent Details.
 *
 * Maps to the official Fivetran endpoint get /v1/hybrid-deployment-agents/{agentId}.
 */
class FivetranGetHybridDeploymentAgent extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_hybrid_deployment_agent';
    protected const DESCRIPTION = 'Returns Hybrid Deployment Agent Details

Official Fivetran endpoint: GET /v1/hybrid-deployment-agents/{agentId}

Returns Hybrid Deployment Agent Details.';
    protected const PARAMETERS = array (
  'agent_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `agentId` from the official Fivetran API operation. Hybrid Deployment Agent Id',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/hybrid-deployment-agents/{agentId}';
    protected const PATH_PARAMS = array (
  'agentId' => 'agent_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
