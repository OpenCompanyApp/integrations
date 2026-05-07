<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral voice.
 */
class MistralCreateVoice extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_voice';
    protected const DESCRIPTION = 'Create a Mistral audio voice.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/audio/voices';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Voice create body matching the Mistral API schema.']];
}
