<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Analyze text or a URL with Deepgram Text Intelligence.
 */
class DeepgramAnalyzeText extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_analyze_text';
    protected const DESCRIPTION = 'Analyze text or a text URL for summarization, topic detection, intent recognition, and sentiment with Deepgram Read.';
    protected const SERVICE_METHOD = 'analyzeText';
    protected const MODE = 'body_query';
    protected const QUERY_KEYS = ['sentiment', 'summarize', 'topics', 'custom_topic', 'custom_topic_mode', 'intents', 'custom_intent', 'custom_intent_mode', 'language', 'callback', 'callback_method', 'tag'];
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body containing text or url.'],
        'sentiment' => ['type' => 'boolean', 'description' => 'Detect sentiment.'],
        'summarize' => ['type' => ['boolean', 'string'], 'description' => 'Generate summary.'],
        'topics' => ['type' => 'boolean', 'description' => 'Detect topics.'],
        'intents' => ['type' => 'boolean', 'description' => 'Detect intents.'],
        'language' => ['type' => 'string', 'description' => 'Language hint, default en.'],
    ];
}
