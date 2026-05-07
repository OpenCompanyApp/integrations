<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Transcribe prerecorded media from a hosted URL.
 */
class DeepgramTranscribeUrl extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_transcribe_url';
    protected const DESCRIPTION = 'Transcribe prerecorded audio or video from a URL with Deepgram Listen. The body object must contain url; query parameters control model and analysis features.';
    protected const SERVICE_METHOD = 'transcribeUrl';
    protected const MODE = 'body_query';
    protected const QUERY_KEYS = ['model', 'language', 'detect_language', 'smart_format', 'punctuate', 'diarize', 'utterances', 'paragraphs', 'summarize', 'sentiment', 'topics', 'intents', 'detect_entities', 'redact', 'replace', 'search', 'callback', 'callback_method', 'tag', 'extra', 'mip_opt_out', 'filler_words', 'keyterm', 'keywords', 'profanity_filter', 'multichannel', 'channels', 'alternatives', 'numerals', 'dictation', 'encoding', 'sample_rate', 'version'];
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body, usually { "url": "https://example.test/audio.wav" }.'],
        'model' => ['type' => 'string', 'description' => 'Speech-to-text model.'],
        'language' => ['type' => 'string', 'description' => 'BCP-47 language hint.'],
        'detect_language' => ['type' => ['boolean', 'array'], 'description' => 'Detect dominant language.'],
        'smart_format' => ['type' => 'boolean', 'description' => 'Apply smart transcript formatting.'],
        'punctuate' => ['type' => 'boolean', 'description' => 'Add punctuation and capitalization.'],
        'diarize' => ['type' => 'boolean', 'description' => 'Detect speaker changes.'],
        'utterances' => ['type' => 'boolean', 'description' => 'Segment speech into utterances.'],
        'summarize' => ['type' => ['boolean', 'string'], 'description' => 'Generate summary.'],
        'sentiment' => ['type' => 'boolean', 'description' => 'Detect sentiment.'],
        'topics' => ['type' => 'boolean', 'description' => 'Detect topics.'],
        'intents' => ['type' => 'boolean', 'description' => 'Detect intents.'],
        'detect_entities' => ['type' => 'boolean', 'description' => 'Detect entities.'],
        'tag' => ['type' => ['string', 'array'], 'description' => 'Usage reporting tags.'],
    ];
}
