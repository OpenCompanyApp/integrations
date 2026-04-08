<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxUploadFile implements Tool
{
    /**
     * Create a new BoxUploadFile tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_upload_file';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Upload a file to Box. Provide the file name, content, and optionally a parent folder ID (defaults to root). Returns the uploaded file metadata.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'file_name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the file in Box, including extension (e.g., "report.pdf").'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The file contents as a string.'],
            'parent_folder_id' => ['type' => 'string', 'description' => 'The parent folder ID. Use "0" for the root folder.', 'default' => '0'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Box integration is not configured.');
            }

            $fileName = $args['file_name'];
            $content = $args['content'];
            $parentId = $args['parent_folder_id'] ?? '0';

            if (empty($fileName)) {
                return ToolResult::error('file_name is required.');
            }

            if (empty($content)) {
                return ToolResult::error('content is required.');
            }

            $result = $this->service->uploadFile($content, $fileName, $parentId);

            $entries = $result['entries'] ?? [];
            $file = $entries[0] ?? $result;

            return ToolResult::success([
                'id' => $file['id'] ?? null,
                'type' => $file['type'] ?? 'file',
                'name' => $file['name'] ?? $fileName,
                'size' => $file['size'] ?? null,
                'parent' => $file['parent'] ?? ['id' => $parentId],
                'message' => "File '{$fileName}' uploaded successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
