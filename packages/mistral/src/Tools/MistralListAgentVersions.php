<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List versions of a Mistral agent.
 */
class MistralListAgentVersions extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_agent_versions';
    protected const DESCRIPTION = 'List versions for a Mistral agent.';
    protected const PATH = '/v1/agents/{agent_id}/versions';
    protected const PATH_PARAMS = ['agent_id'];
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.'], 'query' => ['type' => 'object', 'description' => 'Optional version list query parameters.']];
}
