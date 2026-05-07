<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve Mistral conversation history.
 */
class MistralConversationHistory extends AbstractMistralTool
{
    protected const NAME = 'mistral_conversation_history';
    protected const DESCRIPTION = 'Get the history for a Mistral conversation.';
    protected const PATH = '/v1/conversations/{conversation_id}/history';
    protected const PATH_PARAMS = ['conversation_id'];
    protected const PARAMETERS = ['conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral conversation ID.'], 'query' => ['type' => 'object', 'description' => 'Optional history query parameters.']];
}
