<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Agent Builder integrations settings.
 *
 * Maps to the official LangSmith endpoint GET /v1/agent-builder/integrations.
 */
class LangSmithGetV1AgentBuilderIntegrations extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_agent_builder_integrations';
    protected const DESCRIPTION = 'Get Agent Builder integrations settings

Official endpoint: GET /v1/agent-builder/integrations
Returns default policy, integration overrides, and known integrations for the current workspace.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/agent-builder/integrations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
