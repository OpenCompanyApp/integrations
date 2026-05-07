<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a Mistral conversation.
 */
class MistralGetConversation extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_conversation';
    protected const DESCRIPTION = 'Get a Mistral conversation by conversation_id.';
    protected const PATH = '/v1/conversations/{conversation_id}';
    protected const PATH_PARAMS = ['conversation_id'];
    protected const PARAMETERS = ['conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral conversation ID.']];
}
