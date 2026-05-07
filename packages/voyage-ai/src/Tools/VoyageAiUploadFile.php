<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a JSONL file for Voyage AI batch inference.
 *
 * Sends multipart form data with file content and purpose, matching the
 * official Files API upload endpoint.
 */
class VoyageAiUploadFile extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_upload_file';
    }

    public function description(): string
    {
        return 'Upload a JSONL file for Voyage AI Batch API. The file content must already be formatted for the selected batch endpoint.';
    }

    public function parameters(): array
    {
        return [
            'filename' => ['type' => 'string', 'required' => true, 'description' => 'Filename to send to Voyage AI, usually ending in .jsonl.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'Raw JSONL file content.'],
            'purpose' => ['type' => 'string', 'description' => 'File purpose. Currently must be batch. Defaults to batch.'],
        ];
    }

    /**
     * Execute the file upload API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing filename, content, and optional purpose.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            $purpose = (string) ($args['purpose'] ?? 'batch');
            if ($purpose !== 'batch') {
                return ToolResult::error('purpose must be "batch".');
            }

            return ToolResult::success($this->service->uploadFile(
                $this->requireString($args, 'filename'),
                $this->requireString($args, 'content'),
                $purpose,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
