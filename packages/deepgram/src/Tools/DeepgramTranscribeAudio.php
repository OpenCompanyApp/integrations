<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Transcribe prerecorded media from raw audio bytes.
 */
class DeepgramTranscribeAudio extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_transcribe_audio';
    protected const DESCRIPTION = 'Transcribe raw audio bytes with Deepgram Listen. Provide content and content_type; query parameters control model and analysis features.';
    protected const QUERY_KEYS = ['model', 'language', 'detect_language', 'smart_format', 'punctuate', 'diarize', 'utterances', 'paragraphs', 'summarize', 'sentiment', 'topics', 'intents', 'detect_entities', 'redact', 'replace', 'search', 'callback', 'callback_method', 'tag', 'extra', 'mip_opt_out', 'filler_words', 'keyterm', 'keywords', 'profanity_filter', 'multichannel', 'channels', 'alternatives', 'numerals', 'dictation', 'encoding', 'sample_rate', 'version'];
    protected const PARAMETERS = [
        'content' => ['type' => 'string', 'required' => true, 'description' => 'Raw audio file bytes as a string from the host.'],
        'content_type' => ['type' => 'string', 'required' => true, 'description' => 'Audio MIME type, for example audio/wav or audio/mpeg.'],
        'model' => ['type' => 'string', 'description' => 'Speech-to-text model.'],
        'language' => ['type' => 'string', 'description' => 'BCP-47 language hint.'],
        'smart_format' => ['type' => 'boolean', 'description' => 'Apply smart transcript formatting.'],
        'diarize' => ['type' => 'boolean', 'description' => 'Detect speaker changes.'],
    ];

    /**
     * Execute the Deepgram raw audio transcription call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing content, content_type, and Listen query parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Deepgram integration is not configured.');
            }

            return ToolResult::success($this->service->transcribeAudio(
                $this->requireString($args, 'content'),
                $this->requireString($args, 'content_type'),
                $this->only($args, static::QUERY_KEYS),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
