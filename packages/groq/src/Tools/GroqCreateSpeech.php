<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Create speech audio from text.
 */
class GroqCreateSpeech extends AbstractGroqTool
{
    protected const NAME = 'groq_create_speech';
    protected const DESCRIPTION = 'Generate speech audio from text through Groq text-to-speech.';
    protected const METHOD = 'createSpeech';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
