<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Generate speech audio from text.
 */
class DeepgramSpeak extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_speak';
    protected const DESCRIPTION = 'Generate natural-sounding speech audio from text with Deepgram Speak. Returns content_type and audio_base64.';
    protected const SERVICE_METHOD = 'speak';
    protected const MODE = 'body_query';
    protected const QUERY_KEYS = ['model', 'encoding', 'container', 'sample_rate', 'bit_rate', 'callback', 'callback_method', 'mip_opt_out'];
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body containing text.'],
        'model' => ['type' => 'string', 'description' => 'TTS model, for example aura-2-thalia-en.'],
        'encoding' => ['type' => 'string', 'description' => 'Output audio encoding.'],
        'container' => ['type' => 'string', 'description' => 'Output container format.'],
        'sample_rate' => ['type' => 'integer', 'description' => 'Output sample rate.'],
        'bit_rate' => ['type' => 'integer', 'description' => 'Output bit rate.'],
    ];
}
