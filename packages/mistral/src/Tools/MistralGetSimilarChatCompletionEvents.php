<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get similar Mistral chat completion events.
 */
class MistralGetSimilarChatCompletionEvents extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_similar_chat_completion_events';
    protected const DESCRIPTION = 'Get similar Mistral chat completion events.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/chat-completion-events/{event_id}/similar-events';
    protected const PATH_PARAMS = ['event_id'];
    protected const PARAMETERS = ['event_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral event_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
