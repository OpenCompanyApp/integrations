<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral agent alias.
 */
class MistralDeleteAgentAlias extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_agent_alias';
    protected const DESCRIPTION = 'Delete a version alias for a Mistral agent.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/agents/{agent_id}/aliases';
    protected const PATH_PARAMS = ['agent_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Alias delete body matching the Mistral API schema.']];
}
