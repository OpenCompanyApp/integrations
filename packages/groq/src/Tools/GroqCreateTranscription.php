<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Create an audio transcription.
 */
class GroqCreateTranscription extends AbstractGroqTool
{
    protected const NAME = 'groq_create_transcription';
    protected const DESCRIPTION = 'Transcribe audio using Groq speech-to-text. Provide payload with model plus url or file_path.';
    protected const METHOD = 'createTranscription';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
