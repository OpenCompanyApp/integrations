<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create or update a Mistral agent alias.
 */
class MistralUpsertAgentAlias extends AbstractMistralTool
{
    protected const NAME = 'mistral_upsert_agent_alias';
    protected const DESCRIPTION = 'Create or update a version alias for a Mistral agent.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/agents/{agent_id}/aliases';
    protected const PATH_PARAMS = ['agent_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral agent ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Alias upsert body matching the Mistral API schema.']];
}
