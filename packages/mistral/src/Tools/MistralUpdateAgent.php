<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update a Mistral agent.
 */
class MistralUpdateAgent extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_agent';
    protected const DESCRIPTION = 'Patch a Mistral agent by agent_id.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/agents/{agent_id}';
    protected const PATH_PARAMS = ['agent_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Agent update body matching the Mistral API schema.']];
}
