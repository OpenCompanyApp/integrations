<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\Integrations\Gotify\GotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GotifyGetHealth implements Tool
{
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_get_health';
    }

    public function description(): string
    {
        return 'Check the health status of the Gotify server. Returns server health information including database status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gotify integration is not configured.');
            }

            $result = $this->service->getHealth();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
