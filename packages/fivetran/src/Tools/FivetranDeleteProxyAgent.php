<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Proxy Agent.
 *
 * Maps to the official Fivetran endpoint delete /v1/proxy/{agentId}.
 */
class FivetranDeleteProxyAgent extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_proxy_agent';
    protected const DESCRIPTION = 'Delete a Proxy Agent

Official Fivetran endpoint: DELETE /v1/proxy/{agentId}

Deletes the specified proxy agent from your Fivetran account.';
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
    protected const METHOD = 'delete';
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
