<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Transcribe audio with Mistral.
 */
class MistralTranscribeAudio extends AbstractMistralTool
{
    protected const NAME = 'mistral_transcribe_audio';
    protected const DESCRIPTION = 'Transcribe audio using Mistral audio transcription.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/audio/transcriptions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Audio transcription body matching the Mistral API schema.']];
}
