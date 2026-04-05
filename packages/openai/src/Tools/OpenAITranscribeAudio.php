<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Transcribe audio using OpenAI Whisper.
 *
 * Accepts raw audio file content and returns a text transcription.
 * Supports MP3, MP4, MPEG, MPGA, M4A, WAV, and WEBM formats.
 */
class OpenAITranscribeAudio implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_transcribe_audio';
    }

    public function description(): string
    {
        return 'Transcribe audio into text using OpenAI Whisper. Supports MP3, MP4, WAV, M4A, and WEBM audio files.';
    }

    public function parameters(): array
    {
        return [
            'file_content' => ['type' => 'string', 'required' => true, 'description' => 'Base64-encoded audio file content.'],
            'filename' => ['type' => 'string', 'required' => true, 'description' => 'Filename with extension (e.g., "audio.mp3", "recording.wav").'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Model to use for transcription (e.g., "whisper-1").'],
            'language' => ['type' => 'string', 'description' => 'ISO 639-1 language code (e.g., "en", "fr", "de").'],
            'response_format' => ['type' => 'string', 'description' => 'Output format: "json", "text", "srt", "verbose_json", "vtt".'],
        ];
    }

    /**
     * Transcribe an audio file to text.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_content, filename, model, etc.)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $fileContent = $args['file_content'] ?? '';
            $filename = $args['filename'] ?? '';
            $model = $args['model'] ?? '';

            if (empty($fileContent)) {
                return ToolResult::error('file_content is required.');
            }
            if (empty($filename)) {
                return ToolResult::error('filename is required.');
            }
            if (empty($model)) {
                return ToolResult::error('model is required.');
            }

            // Decode base64 content if it looks like base64
            $rawContent = $fileContent;
            if (preg_match('/^[a-zA-Z0-9\/\r\n+]+=*$/', $fileContent)) {
                $decoded = base64_decode($fileContent, true);
                if ($decoded !== false) {
                    $rawContent = $decoded;
                }
            }

            $params = [];

            if (isset($args['language'])) {
                $params['language'] = $args['language'];
            }
            if (isset($args['response_format'])) {
                $params['response_format'] = $args['response_format'];
            }

            $result = $this->service->transcribeAudio($rawContent, $filename, $model, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
