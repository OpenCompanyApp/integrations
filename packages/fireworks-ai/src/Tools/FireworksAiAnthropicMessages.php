<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Create a Message.
 */
class FireworksAiAnthropicMessages extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_anthropic_messages';
    protected const DESCRIPTION = 'Create a Message.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/messages';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
