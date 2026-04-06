<?php

namespace OpenCompany\Integrations\Canva\Tools;

use OpenCompany\Integrations\Canva\CanvaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CanvaGetFolder implements Tool
{
    public function __construct(
        private CanvaService $service,
    ) {}

    public function name(): string
    {
        return 'canva_get_folder';
    }

    public function description(): string
    {
        return 'Get details of a specific Canva folder by its ID, including name and contained items.';
    }

    public function parameters(): array
    {
        return [
            'folder_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the folder to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Canva integration is not configured.');
            }

            $result = $this->service->getFolder($args['folder_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
