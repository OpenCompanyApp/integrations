<?php

namespace OpenCompany\Integrations\FlyIo\Tools;

use OpenCompany\Integrations\FlyIo\FlyIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Fly Machine by app name and machine ID.
 */
class FlyIoGetMachine implements Tool
{
    /**
     * @param  FlyIoService  $service  The Fly.io Machines API client.
     */
    public function __construct(
        private FlyIoService $service,
    ) {}

    public function name(): string
    {
        return 'fly_io_get_machine';
    }

    public function description(): string
    {
        return 'Get details for a specific Fly.io machine, including its state, config, and region.';
    }

    public function parameters(): array
    {
        return [
            'app_name' => ['type' => 'string', 'description' => 'The name of the Fly.io app.'],
            'machine_id' => ['type' => 'string', 'description' => 'The machine ID.'],
        ];
    }

    /**
     * Fetch a Machine for a Fly App.
     *
     * @param  array<string, mixed>  $args  Tool arguments (app_name, machine_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fly.io integration is not configured.');
            }

            $appName = $args['app_name'] ?? '';
            $machineId = $args['machine_id'] ?? '';

            if (empty($appName)) {
                return ToolResult::error('The app_name parameter is required.');
            }
            if (empty($machineId)) {
                return ToolResult::error('The machine_id parameter is required.');
            }

            $result = $this->service->getMachine($appName, $machineId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
