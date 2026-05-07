<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Transcribe audio with Cohere v2 Audio Transcriptions.
 *
 * Sends multipart file content with model, language, and optional temperature.
 */
class CohereCreateAudioTranscription extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_create_audio_transcription';
    }

    public function description(): string
    {
        return 'Transcribe an audio file with Cohere v2 Audio Transcriptions. Provide file content directly; supported extensions include flac, mp3, mpeg, mpga, ogg, and wav.';
    }

    public function parameters(): array
    {
        return [
            'filename' => ['type' => 'string', 'required' => true, 'description' => 'Audio filename including extension.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'Raw audio file bytes as a string from the host.'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Transcription model ID, for example cohere-transcribe-03-2026.'],
            'language' => ['type' => 'string', 'required' => true, 'description' => 'ISO-639-1 language code, for example en.'],
            'temperature' => ['type' => 'number', 'description' => 'Optional sampling temperature between 0 and 1.'],
        ];
    }

    /**
     * Execute the Cohere Create Audio Transcription API call.
     *
     * @param  array<string, mixed>  $args  Multipart audio transcription arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            $temperature = isset($args['temperature']) ? (float) $args['temperature'] : null;

            return ToolResult::success($this->service->createAudioTranscription(
                $this->requireString($args, 'filename'),
                $this->requireString($args, 'content'),
                $this->requireString($args, 'model'),
                $this->requireString($args, 'language'),
                $temperature,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
