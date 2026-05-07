<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a Mistral agent.
 */
class MistralGetAgent extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_agent';
    protected const DESCRIPTION = 'Get a Mistral agent by agent_id.';
    protected const PATH = '/v1/agents/{agent_id}';
    protected const PATH_PARAMS = ['agent_id'];
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.']];
}
