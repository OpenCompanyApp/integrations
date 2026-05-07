<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List aliases for a Mistral agent.
 */
class MistralListAgentAliases extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_agent_aliases';
    protected const DESCRIPTION = 'List version aliases for a Mistral agent.';
    protected const PATH = '/v1/agents/{agent_id}/aliases';
    protected const PATH_PARAMS = ['agent_id'];
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.']];
}
