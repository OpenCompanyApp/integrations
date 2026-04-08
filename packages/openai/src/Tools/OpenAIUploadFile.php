<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a file to OpenAI.
 *
 * Uploads a file for use with features like Assistants, Fine-tuning,
 * or Batch API. File content should be provided as base64-encoded data.
 */
class OpenAIUploadFile implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_upload_file';
    }

    public function description(): string
    {
        return 'Upload a file to OpenAI for use with Assistants, Fine-tuning, or Batch API.';
    }

    public function parameters(): array
    {
        return [
            'file_content' => ['type' => 'string', 'required' => true, 'description' => 'Base64-encoded file content.'],
            'filename' => ['type' => 'string', 'required' => true, 'description' => 'Filename with extension (e.g., "data.jsonl", "document.txt").'],
            'purpose' => ['type' => 'string', 'required' => true, 'description' => 'Purpose of the file: "assistants", "assistants_output", "batch", "fine-tune", "vision".'],
        ];
    }

    /**
     * Upload a file to OpenAI.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_content, filename, purpose)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $fileContent = $args['file_content'] ?? '';
            $filename = $args['filename'] ?? '';
            $purpose = $args['purpose'] ?? '';

            if (empty($fileContent)) {
                return ToolResult::error('file_content is required.');
            }
            if (empty($filename)) {
                return ToolResult::error('filename is required.');
            }
            if (empty($purpose)) {
                return ToolResult::error('purpose is required.');
            }

            // Decode base64 content
            $rawContent = base64_decode($fileContent, true);
            if ($rawContent === false) {
                return ToolResult::error('file_content must be valid base64-encoded data.');
            }

            $result = $this->service->uploadFile($rawContent, $filename, $purpose);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'object' => $result['object'] ?? '',
                'filename' => $result['filename'] ?? $filename,
                'bytes' => $result['bytes'] ?? 0,
                'created_at' => $result['created_at'] ?? 0,
                'purpose' => $result['purpose'] ?? $purpose,
                'status' => $result['status'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
