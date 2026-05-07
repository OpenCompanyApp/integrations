<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Get Deepgram project usage breakdown.
 */
class DeepgramGetUsageBreakdown extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_get_usage_breakdown';
    protected const DESCRIPTION = 'Get Deepgram project usage breakdown with date, endpoint, model, feature, tag, and grouping filters.';
    protected const SERVICE_METHOD = 'getUsageBreakdown';
    protected const MODE = 'id_query';
    protected const ID_KEY = 'project_id';
    protected const QUERY_KEYS = ['start', 'end', 'resolution', 'accessor', 'endpoint', 'method', 'model', 'tag', 'deployment', 'measurements', 'callback', 'callback_method', 'channels', 'custom_intent_mode', 'custom_intent', 'custom_topic_mode', 'custom_topic', 'detect_entities', 'detect_language', 'diarize', 'dictation', 'encoding', 'extra', 'filler_words', 'intents', 'keyterm', 'keywords', 'language', 'multichannel', 'numerals', 'paragraphs', 'profanity_filter', 'punctuate', 'redact', 'replace', 'search', 'sentiment', 'smart_format', 'summarize', 'topics', 'utt_split', 'utterances', 'version'];
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'start' => ['type' => 'string', 'description' => 'Start date in YYYY-MM-DD format.'],
        'end' => ['type' => 'string', 'description' => 'End date in YYYY-MM-DD format.'],
        'endpoint' => ['type' => 'string', 'description' => 'Filter or group by endpoint such as listen, read, or speak.'],
        'model' => ['type' => 'string', 'description' => 'Filter or group by model.'],
        'tag' => ['type' => 'string', 'description' => 'Filter or group by usage tag.'],
        'measurements' => ['type' => 'boolean', 'description' => 'Include measurement grouping.'],
    ];
}
