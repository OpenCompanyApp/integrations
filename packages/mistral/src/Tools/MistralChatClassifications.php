<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Classify chat messages with Mistral.
 */
class MistralChatClassifications extends AbstractMistralTool
{
    protected const NAME = 'mistral_chat_classifications';
    protected const DESCRIPTION = 'Run Mistral classifications over chat messages.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/chat/classifications';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Chat classification body matching the Mistral API schema.']];
}
