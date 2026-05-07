<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve Mistral conversation messages.
 */
class MistralConversationMessages extends AbstractMistralTool
{
    protected const NAME = 'mistral_conversation_messages';
    protected const DESCRIPTION = 'List messages for a Mistral conversation.';
    protected const PATH = '/v1/conversations/{conversation_id}/messages';
    protected const PATH_PARAMS = ['conversation_id'];
    protected const PARAMETERS = ['conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral conversation ID.'], 'query' => ['type' => 'object', 'description' => 'Optional message query parameters.']];
}
