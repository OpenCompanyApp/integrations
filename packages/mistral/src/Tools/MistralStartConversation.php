<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Start a Mistral conversation.
 */
class MistralStartConversation extends AbstractMistralTool
{
    protected const NAME = 'mistral_start_conversation';
    protected const DESCRIPTION = 'Start a Mistral conversation with the Conversations API.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/conversations';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Conversation start body matching the Mistral API schema.']];
}
