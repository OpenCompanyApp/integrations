<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a Mistral observability chat completion event.
 */
class MistralGetChatCompletionEvent extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_chat_completion_event';
    protected const DESCRIPTION = 'Get a Mistral observability chat completion event.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/chat-completion-events/{event_id}';
    protected const PATH_PARAMS = ['event_id'];
    protected const PARAMETERS = ['event_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral event_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
