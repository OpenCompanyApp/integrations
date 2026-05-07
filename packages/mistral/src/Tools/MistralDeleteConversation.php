<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral conversation.
 */
class MistralDeleteConversation extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_conversation';
    protected const DESCRIPTION = 'Delete a Mistral conversation by conversation_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/conversations/{conversation_id}';
    protected const PATH_PARAMS = ['conversation_id'];
    protected const PARAMETERS = ['conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral conversation ID.']];
}
