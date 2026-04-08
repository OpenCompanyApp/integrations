<?php

namespace OpenCompany\Integrations\FlyIo\Tools;

use OpenCompany\Integrations\FlyIo\FlyIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FlyIoListApps implements Tool
{
    public function __construct(
        private FlyIoService $service,
    ) {}

    public function name(): string
    {
        return 'fly_io_list_apps';
    }

    public function description(): string
    {
        return 'List all Fly.io apps in the organization. Returns app names, IDs, status, and network details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fly.io integration is not configured.');
            }

            $result = $this->service->listApps();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
