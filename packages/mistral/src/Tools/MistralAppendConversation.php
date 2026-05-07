<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Append messages to a Mistral conversation.
 */
class MistralAppendConversation extends AbstractMistralTool
{
    protected const NAME = 'mistral_append_conversation';
    protected const DESCRIPTION = 'Append messages to an existing Mistral conversation.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/conversations/{conversation_id}';
    protected const PATH_PARAMS = ['conversation_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral conversation ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Conversation append body matching the Mistral API schema.']];
}
