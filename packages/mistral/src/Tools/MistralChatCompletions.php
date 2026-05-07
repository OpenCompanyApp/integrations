<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral chat completion.
 */
class MistralChatCompletions extends AbstractMistralTool
{
    protected const NAME = 'mistral_chat_completions';
    protected const DESCRIPTION = 'Create a Mistral chat completion using the official /v1/chat/completions body.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/chat/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Chat completion body with model, messages, tools, response_format, temperature, and other supported fields.']];
}
