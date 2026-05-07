<?php

namespace OpenCompany\Integrations\Cerebras\Tools;

/**
 * Create a Cerebras chat completion.
 */
class CerebrasChatCompletions extends AbstractCerebrasTool
{
    protected const NAME = 'cerebras_chat_completions';
    protected const DESCRIPTION = 'Create a Cerebras chat completion.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/chat/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'description' => 'Request body or multipart fields matching the Cerebras API schema.']];
}
