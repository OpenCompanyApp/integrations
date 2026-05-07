<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Submit an audio or video file URL for transcription.
 *
 * Sends a POST request to /transcript with the audio_url and optional
 * transcription settings. Returns the created transcript resource with
 * its ID and initial status (typically "queued" or "processing").
 *
 * @see https://www.assemblyai.com/docs/getting-started/transcribe-an-audio-file
 */
class AssemblyAITranscribe implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI service instance.
     */
    public function __construct(
        private AssemblyAIService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'assemblyai_transcribe';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Submit an audio or video file URL for AI transcription. Supports speech-to-text, speaker diarization, summarization, sentiment analysis, and more. Returns a transcript ID to poll for results.';
    }

    /**
     * Parameter schema for the transcription request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'audio_url' => ['type' => 'string', 'required' => true, 'description' => 'URL of the audio or video file to transcribe. Can also be an AssemblyAI upload URL from the upload tool.'],
            'language_code' => ['type' => 'string', 'description' => 'Language code (e.g., "en_us", "es", "fr"). Defaults to auto-detection if omitted.'],
            'speaker_labels' => ['type' => 'boolean', 'description' => 'Enable speaker diarization to identify who spoke and when.'],
            'auto_chapters' => ['type' => 'boolean', 'description' => 'Automatically break the transcript into chapters.'],
            'entity_detection' => ['type' => 'boolean', 'description' => 'Detect entities like dates, locations, and organizations in the transcript.'],
            'sentiment_analysis' => ['type' => 'boolean', 'description' => 'Analyze sentiment (positive, negative, neutral) for each sentence.'],
            'summarization' => ['type' => 'boolean', 'description' => 'Generate a summary of the transcript.'],
            'punctuate' => ['type' => 'boolean', 'description' => 'Add punctuation to the transcript.'],
            'format_text' => ['type' => 'boolean', 'description' => 'Format text with capitalization and paragraph breaks.'],
            'webhook_url' => ['type' => 'string', 'description' => 'URL to receive a webhook when the transcript is complete.'],
            'custom_topics' => ['type' => 'array', 'description' => 'List of custom topics to detect in the audio.'],
            'topics' => ['type' => 'array', 'description' => 'Enable topic detection with AssemblyAI\'s built-in topics.'],
        ];
    }

    /**
     * Execute the transcription request.
     *
     * @param  array  $args  The transcription parameters.
     * @return ToolResult The created transcript resource or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            if (empty($args['audio_url'])) {
                return ToolResult::error('audio_url is required.');
            }

            $options = [
                'audio_url' => $args['audio_url'],
            ];

            $optionalKeys = [
                'speech_model', 'speech_models', 'language_code', 'language_codes',
                'language_detection', 'language_confidence_threshold', 'speaker_labels',
                'speakers_expected', 'multichannel', 'auto_chapters', 'auto_highlights',
                'entity_detection', 'sentiment_analysis', 'summarization', 'summary_model',
                'summary_type', 'content_safety', 'iab_categories', 'punctuate',
                'format_text', 'disfluencies', 'filter_profanity', 'redact_pii',
                'redact_pii_audio', 'redact_pii_audio_quality', 'redact_pii_policies',
                'redact_pii_sub', 'webhook_url', 'webhook_auth_header_name',
                'webhook_auth_header_value', 'custom_spelling', 'custom_topics',
                'topics', 'keyterms_prompt', 'word_boost', 'boost_param',
                'audio_start_from', 'audio_end_at',
            ];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $options[$key] = $args[$key];
                }
            }

            $result = $this->service->transcribe($options);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'status' => $result['status'] ?? 'unknown',
                'audio_url' => $result['audio_url'] ?? $args['audio_url'],
                'resource_url' => $result['resource_url'] ?? null,
                'message' => 'Transcription submitted. Use assemblyai_get_transcript with the ID to check status and retrieve results.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
