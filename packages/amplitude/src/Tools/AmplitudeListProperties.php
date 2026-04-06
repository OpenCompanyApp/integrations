<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeListProperties — List event or user properties.
 *
 * Calls GET /api/2/properties with a type parameter ("event" or "user").
 * Returns all property names available in the Amplitude project.
 */
class AmplitudeListProperties implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_list_properties';
    }

    public function description(): string
    {
        return 'List available properties in Amplitude. Supports both event properties and user properties. Use this to discover which property names are available for filtering or analysis.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Property type: "event" (default) or "user".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $type = $args['type'] ?? 'event';

            if (!in_array($type, ['event', 'user'], true)) {
                return ToolResult::error('Invalid type. Must be "event" or "user".');
            }

            $result = $this->service->listProperties($type);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
