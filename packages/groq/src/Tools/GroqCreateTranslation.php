<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Create an audio translation.
 */
class GroqCreateTranslation extends AbstractGroqTool
{
    protected const NAME = 'groq_create_translation';
    protected const DESCRIPTION = 'Translate audio into English using Groq speech-to-text. Provide payload with model plus url or file_path.';
    protected const METHOD = 'createTranslation';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
