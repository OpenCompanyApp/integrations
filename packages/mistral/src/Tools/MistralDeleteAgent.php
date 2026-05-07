<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral agent.
 */
class MistralDeleteAgent extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_agent';
    protected const DESCRIPTION = 'Delete a Mistral agent by agent_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/agents/{agent_id}';
    protected const PATH_PARAMS = ['agent_id'];
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.']];
}
