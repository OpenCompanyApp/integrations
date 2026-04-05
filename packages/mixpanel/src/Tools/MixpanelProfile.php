<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Mixpanel user profile via the Engage API.
 *
 * Supports set, set_once, add, append, union, unset, and delete
 * operations on user profile properties.
 */
class MixpanelProfile implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_profile';
    }

    public function description(): string
    {
        return 'Set or update a Mixpanel user profile with properties.';
    }

    public function parameters(): array
    {
        return [
            'distinct_id' => ['type' => 'string', 'required' => true, 'description' => 'The user\'s distinct ID in Mixpanel.'],
            'properties'  => ['type' => 'string', 'required' => true, 'description' => 'JSON object of profile properties (e.g., {"$name":"John","$email":"john@example.com"}).'],
            'operation'   => ['type' => 'string', 'description' => 'Profile operation: "set", "set_once", "add", "append", "union", "unset", or "delete". Defaults to "set".'],
        ];
    }

    /**
     * Update a user profile in Mixpanel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (distinct_id, properties, operation)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $distinctId = $args['distinct_id'] ?? '';

            if (empty($distinctId)) {
                return ToolResult::error('distinct_id is required.');
            }

            $properties = $args['properties'] ?? [];

            if (empty($properties)) {
                return ToolResult::error('properties is required.');
            }

            if (is_string($properties)) {
                $properties = json_decode($properties, true);
            }

            if (! is_array($properties)) {
                return ToolResult::error('properties must be a valid JSON object.');
            }

            $operation = $args['operation'] ?? 'set';

            $result = $this->service->profile($distinctId, $properties, $operation);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
