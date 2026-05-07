<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Proxy Agent Details.
 *
 * Maps to the official Fivetran endpoint get /v1/proxy/{agentId}.
 */
class FivetranGetProxyAgentDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_proxy_agent_details';
    protected const DESCRIPTION = 'Retrieve Proxy Agent Details

Official Fivetran endpoint: GET /v1/proxy/{agentId}

Retrieves the details of the specified proxy agent.';
    protected const PARAMETERS = array (
  'agent_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `agentId` from the official Fivetran API operation. The unique identifier for the proxy agent within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/proxy/{agentId}';
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
