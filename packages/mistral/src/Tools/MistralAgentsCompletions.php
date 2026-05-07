<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a completion with a Mistral agent.
 */
class MistralAgentsCompletions extends AbstractMistralTool
{
    protected const NAME = 'mistral_agents_completions';
    protected const DESCRIPTION = 'Create a completion with a Mistral agent using /v1/agents/completions.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/agents/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Agent completion body with agent_id, messages, and options.']];
}
