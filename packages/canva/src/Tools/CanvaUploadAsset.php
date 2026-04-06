<?php

namespace OpenCompany\Integrations\Canva\Tools;

use OpenCompany\Integrations\Canva\CanvaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CanvaUploadAsset implements Tool
{
    public function __construct(
        private CanvaService $service,
    ) {}

    public function name(): string
    {
        return 'canva_upload_asset';
    }

    public function description(): string
    {
        return 'Upload an asset to Canva from a URL. The file is imported into the user\'s Canva account and can optionally be placed in a specific folder.';
    }

    public function parameters(): array
    {
        return [
            'file_url' => ['type' => 'string', 'required' => true, 'description' => 'The URL of the file to upload (must be publicly accessible).'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the uploaded asset in Canva.'],
            'folder_id' => ['type' => 'string', 'description' => 'Optional folder ID to upload the asset into. Use canva_list_folders to find folder IDs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Canva integration is not configured.');
            }

            $result = $this->service->uploadAsset(
                fileUrl: $args['file_url'],
                name: $args['name'],
                folderId: $args['folder_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
