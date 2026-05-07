<?php

namespace OpenCompany\Integrations\Samsara\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Samsara\SamsaraService;

/**
 * Retrieve one fleet vehicle from Samsara.
 */
class SamsaraGetVehicle implements Tool
{
    /**
     * Create a new SamsaraGetVehicle tool instance.
     */
    public function __construct(
        private SamsaraService $service,
    ) {}

    /**
     * Get the tool slug identifier.
     */
    public function name(): string
    {
        return 'samsara_get_vehicle';
    }

    /**
     * Get the human-readable description of this tool.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific vehicle by its Samsara ID, including name, VIN, make, model, year, GPS location, and odometer reading.';
    }

    /**
     * Get the parameter definitions for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Samsara vehicle ID (e.g., "123456789012345").',
            ],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Samsara integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Vehicle ID is required.');
            }

            $result = $this->service->getVehicle($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
