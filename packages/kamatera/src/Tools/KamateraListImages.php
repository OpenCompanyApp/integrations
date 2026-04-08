<?php

namespace OpenCompany\Integrations\Kamatera\Tools;

use OpenCompany\Integrations\Kamatera\KamateraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KamateraListImages implements Tool
{
    public function __construct(
        private KamateraService $service,
    ) {}

    public function name(): string
    {
        return 'kamatera_list_images';
    }

    public function description(): string
    {
        return 'List all available images for server creation in Kamatera. Returns image IDs, names, OS type, and sizes.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kamatera integration is not configured.');
            }

            $result = $this->service->listImages();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
