<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Reset Agent Credentials.
 *
 * Maps to the official Fivetran endpoint post /v1/hybrid-deployment-agents/{agentId}/reset-credentials.
 */
class FivetranResetHybridDeploymentAgentCredentials extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_reset_hybrid_deployment_agent_credentials';
    protected const DESCRIPTION = 'Reset Agent Credentials

Official Fivetran endpoint: POST /v1/hybrid-deployment-agents/{agentId}/reset-credentials

Reset credentials for a Hybrid Deployment Agent.';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/hybrid-deployment-agents/{agentId}/reset-credentials';
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
