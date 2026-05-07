<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Restart a Mistral conversation.
 */
class MistralRestartConversation extends AbstractMistralTool
{
    protected const NAME = 'mistral_restart_conversation';
    protected const DESCRIPTION = 'Restart a Mistral conversation with the official restart body.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/conversations/{conversation_id}/restart';
    protected const PATH_PARAMS = ['conversation_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral conversation ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Conversation restart body matching the Mistral API schema.']];
}
