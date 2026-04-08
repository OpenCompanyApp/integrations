<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a local audio or video file for transcription.
 *
 * Sends a POST request to /upload with the raw file contents as binary data.
 * Returns an upload URL that can be used as the audio_url parameter in the
 * transcribe tool.
 *
 * @see https://www.assemblyai.com/docs/getting-started/upload-a-file
 */
class AssemblyAIUpload implements Tool
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
        return 'assemblyai_upload';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Upload a local audio or video file to AssemblyAI. Returns an upload URL that can be passed to the transcribe tool as the audio_url parameter. Supports most common audio and video formats.';
    }

    /**
     * Parameter schema for the upload request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'file_path' => ['type' => 'string', 'required' => true, 'description' => 'Absolute path to the local audio or video file to upload (e.g., "/tmp/recording.mp3").'],
        ];
    }

    /**
     * Execute the file upload request.
     *
     * @param  array  $args  Must contain 'file_path' with the absolute file path.
     * @return ToolResult The upload URL or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            $filePath = $args['file_path'];

            if (!file_exists($filePath)) {
                return ToolResult::error("File not found: {$filePath}");
            }

            $result = $this->service->upload($filePath);

            return ToolResult::success([
                'upload_url' => $result['upload_url'] ?? null,
                'message' => 'File uploaded successfully. Use the upload_url as the audio_url parameter in the assemblyai_transcribe tool.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
