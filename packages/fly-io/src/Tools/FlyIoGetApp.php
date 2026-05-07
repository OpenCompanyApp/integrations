<?php

namespace OpenCompany\Integrations\FlyIo\Tools;

use OpenCompany\Integrations\FlyIo\FlyIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Fly App by name.
 */
class FlyIoGetApp implements Tool
{
    /**
     * @param  FlyIoService  $service  The Fly.io Machines API client.
     */
    public function __construct(
        private FlyIoService $service,
    ) {}

    public function name(): string
    {
        return 'fly_io_get_app';
    }

    public function description(): string
    {
        return 'Get details for a specific Fly.io app, including status, network, and machine count.';
    }

    public function parameters(): array
    {
        return [
            'app_name' => ['type' => 'string', 'description' => 'The name of the Fly.io app.'],
        ];
    }

    /**
     * Fetch a Fly App by name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (app_name).
     */
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

            $result = $this->service->getApp($appName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
