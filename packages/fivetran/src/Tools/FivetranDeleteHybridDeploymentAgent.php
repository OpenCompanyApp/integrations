<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Hybrid Deployment Agent.
 *
 * Maps to the official Fivetran endpoint delete /v1/hybrid-deployment-agents/{agentId}.
 */
class FivetranDeleteHybridDeploymentAgent extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_hybrid_deployment_agent';
    protected const DESCRIPTION = 'Delete a Hybrid Deployment Agent

Official Fivetran endpoint: DELETE /v1/hybrid-deployment-agents/{agentId}

Delete a Hybrid Deployment Agent.';
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
    protected const METHOD = 'delete';
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
