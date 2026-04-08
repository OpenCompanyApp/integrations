<?php

namespace OpenCompany\Integrations\FlyIo\Tools;

use OpenCompany\Integrations\FlyIo\FlyIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FlyIoListVolumes implements Tool
{
    public function __construct(
        private FlyIoService $service,
    ) {}

    public function name(): string
    {
        return 'fly_io_list_volumes';
    }

    public function description(): string
    {
        return 'List all persistent volumes for a Fly.io app. Returns volume IDs, name, size, and region.';
    }

    public function parameters(): array
    {
        return [
            'app_name' => ['type' => 'string', 'description' => 'The name of the Fly.io app.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fly.io integration is not configured.');
            }

            $appName = $args['app_name'] ?? '';
            if (empty($appName)) {
                return ToolResult::error('The app_name parameter is required.');
            }

            $result = $this->service->listVolumes($appName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
