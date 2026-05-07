<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Agent Builder integrations settings.
 *
 * Maps to the official LangSmith endpoint PUT /v1/agent-builder/integrations.
 */
class LangSmithPutV1AgentBuilderIntegrations extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_put_v1_agent_builder_integrations';
    protected const DESCRIPTION = 'Update Agent Builder integrations settings

Official endpoint: PUT /v1/agent-builder/integrations
Replaces default policy and integration overrides for the current workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/agent-builder/integrations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
