<?php

namespace OpenCompany\Integrations\DigitalOcean\Tools;

use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DigitalOceanListSpaces implements Tool
{
    public function __construct(
        private DigitalOceanService $service,
    ) {}

    public function name(): string
    {
        return 'digitalocean_list_spaces';
    }

    public function description(): string
    {
        return 'List Spaces (S3-compatible object storage buckets) in the DigitalOcean account.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of items per page (default: 20).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DigitalOcean integration is not configured.');
            }

            $result = $this->service->listSpaces();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
