<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral observability chat completion fields.
 */
class MistralListChatCompletionFields extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_chat_completion_fields';
    protected const DESCRIPTION = 'List Mistral observability chat completion fields.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/chat-completion-fields';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
