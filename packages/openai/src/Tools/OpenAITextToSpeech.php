<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate speech audio from text using OpenAI TTS.
 *
 * Converts text input into spoken audio using voices like alloy,
 * echo, fable, onyx, nova, and shimmer. Returns binary audio data.
 */
class OpenAITextToSpeech implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_text_to_speech';
    }

    public function description(): string
    {
        return 'Generate speech audio from text using OpenAI TTS. Returns base64-encoded audio content.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'TTS model ID (e.g., "tts-1", "tts-1-hd").'],
            'input' => ['type' => 'string', 'required' => true, 'description' => 'Text to convert to speech (max 4096 characters).'],
            'voice' => ['type' => 'string', 'required' => true, 'description' => 'Voice to use: "alloy", "echo", "fable", "onyx", "nova", or "shimmer".'],
            'speed' => ['type' => 'number', 'description' => 'Speed of speech (0.25 to 4.0). Default: 1.0.'],
            'response_format' => ['type' => 'string', 'description' => 'Audio format: "mp3", "opus", "aac", "flac", "wav". Default: "mp3".'],
        ];
    }

    /**
     * Generate speech audio from text.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model, input, voice, speed, etc.)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $model = $args['model'] ?? '';
            $input = $args['input'] ?? '';
            $voice = $args['voice'] ?? '';

            if (empty($model)) {
                return ToolResult::error('model is required.');
            }
            if (empty($input)) {
                return ToolResult::error('input is required.');
            }
            if (empty($voice)) {
                return ToolResult::error('voice is required.');
            }

            $data = [
                'model' => $model,
                'input' => $input,
                'voice' => $voice,
            ];

            if (isset($args['speed'])) {
                $data['speed'] = (float) $args['speed'];
            }
            if (isset($args['response_format'])) {
                $data['response_format'] = $args['response_format'];
            }

            $audioContent = $this->service->textToSpeech($data);

            return ToolResult::success([
                'audio_base64' => base64_encode($audioContent),
                'content_type' => $this->contentTypeForFormat($args['response_format'] ?? 'mp3'),
                'size_bytes' => strlen($audioContent),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Get the MIME content type for the given audio format.
     *
     * @param  string  $format  Audio format identifier
     * @return string
     */
    private function contentTypeForFormat(string $format): string
    {
        return match ($format) {
            'mp3' => 'audio/mpeg',
            'opus' => 'audio/opus',
            'aac' => 'audio/aac',
            'flac' => 'audio/flac',
            'wav' => 'audio/wav',
            default => 'audio/mpeg',
        };
    }
}
