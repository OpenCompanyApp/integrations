<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Generate speech audio with Mistral.
 */
class MistralSpeech extends AbstractMistralTool
{
    protected const NAME = 'mistral_speech';
    protected const DESCRIPTION = 'Generate speech audio with Mistral text-to-speech.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/audio/speech';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Speech body with model, input, voice, and format options.']];
}
