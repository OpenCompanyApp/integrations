<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a Hybrid Deployment Agent.
 *
 * Maps to the official Fivetran endpoint post /v1/hybrid-deployment-agents.
 */
class FivetranCreateHybridDeploymentAgent extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_hybrid_deployment_agent';
    protected const DESCRIPTION = 'Create a Hybrid Deployment Agent

Official Fivetran endpoint: POST /v1/hybrid-deployment-agents

Creates a new Hybrid Deployment Agent in a group.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/hybrid-deployment-agents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
