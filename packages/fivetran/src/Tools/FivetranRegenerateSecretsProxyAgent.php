<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Regenerate Secrets for Proxy Agent.
 *
 * Maps to the official Fivetran endpoint post /v1/proxy/{agentId}/regenerate-secrets.
 */
class FivetranRegenerateSecretsProxyAgent extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_regenerate_secrets_proxy_agent';
    protected const DESCRIPTION = 'Regenerate Secrets for Proxy Agent

Official Fivetran endpoint: POST /v1/proxy/{agentId}/regenerate-secrets

Regenerate secrets for proxy agent within your Fivetran account.';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/proxy/{agentId}/regenerate-secrets';
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
