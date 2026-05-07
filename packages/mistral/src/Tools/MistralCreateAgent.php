<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral agent.
 */
class MistralCreateAgent extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_agent';
    protected const DESCRIPTION = 'Create a Mistral agent.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/agents';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Agent create body matching the Mistral API schema.']];
}
