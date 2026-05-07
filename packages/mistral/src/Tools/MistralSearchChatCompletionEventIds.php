<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Search Mistral observability chat completion event IDs.
 */
class MistralSearchChatCompletionEventIds extends AbstractMistralTool
{
    protected const NAME = 'mistral_search_chat_completion_event_ids';
    protected const DESCRIPTION = 'Search Mistral observability chat completion event IDs.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/chat-completion-events/search-ids';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
