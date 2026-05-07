<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Create Chat Completion.
 */
class FireworksAiPostChatcompletions extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_chat_completions';
    protected const DESCRIPTION = 'Create chat completion.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/chat/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
