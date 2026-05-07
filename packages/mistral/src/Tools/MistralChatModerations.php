<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Moderate chat messages with Mistral.
 */
class MistralChatModerations extends AbstractMistralTool
{
    protected const NAME = 'mistral_chat_moderations';
    protected const DESCRIPTION = 'Run Mistral moderation over chat messages.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/chat/moderations';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Chat moderation body with model and messages.']];
}
