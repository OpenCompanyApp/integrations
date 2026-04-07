<?php

namespace OpenCompany\Integrations\Fal\Tools;

use OpenCompany\Integrations\Fal\FalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a file to fal.ai storage.
 *
 * Uploads a local file to the fal.ai platform for use as input in
 * generation requests (e.g., reference images, audio files).
 */
class FalUploadFile implements Tool
{
    public function __construct(
        private FalService $service,
    ) {}

    public function name(): string
    {
        return 'fal_upload_file';
    }

    public function description(): string
    {
        return 'Upload a file to fal.ai storage for use as model input. Returns the file URL.';
    }

    public function parameters(): array
    {
        return [
            'file_path' => ['type' => 'string', 'required' => true, 'description' => 'The local file path to upload.'],
            'file_name' => ['type' => 'string', 'description' => 'Custom file name for the upload. Defaults to the original file name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('fal.ai integration is not configured.');
            }

            if (empty($args['file_path'])) {
                return ToolResult::error('file_path is required.');
            }

            if (!file_exists($args['file_path'])) {
                return ToolResult::error('File not found: ' . $args['file_path']);
            }

            $result = $this->service->uploadFile(
                filePath: $args['file_path'],
                fileName: $args['file_name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
