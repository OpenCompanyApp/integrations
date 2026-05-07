<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Regenerate Authentication Keys.
 *
 * Maps to the official Fivetran endpoint patch /v1/hybrid-deployment-agents/{agentId}/re-auth.
 */
class FivetranReAuthHybridDeploymentAgent extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_re_auth_hybrid_deployment_agent';
    protected const DESCRIPTION = 'Regenerate Authentication Keys

Official Fivetran endpoint: PATCH /v1/hybrid-deployment-agents/{agentId}/re-auth

Regenerate authentication for a Hybrid Deployment Agent.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/hybrid-deployment-agents/{agentId}/re-auth';
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
