<?php

namespace OpenCompany\Integrations\Directus\Tools;

use OpenCompany\Integrations\Directus\DirectusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DirectusListCollections implements Tool
{
    public function __construct(
        private DirectusService $service,
    ) {}

    public function name(): string
    {
        return 'directus_list_collections';
    }

    public function description(): string
    {
        return 'List all available collections (tables) in the Directus instance. Returns collection names and metadata.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Directus integration is not configured.');
            }

            $result = $this->service->listCollections();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
