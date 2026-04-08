<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Wrike space.
 */
class WrikeGetSpace implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_get_space';
    }

    public function description(): string
    {
        return 'Get detailed information about a Wrike space.';
    }

    public function parameters(): array
    {
        return [
            'space_id' => ['type' => 'string', 'required' => true, 'description' => 'The space ID.'],
        ];
    }

    /**
     * Retrieve a space by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (space_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $spaceId = $args['space_id'] ?? '';

            if (empty($spaceId)) {
                return ToolResult::error('space_id is required.');
            }

            $space = $this->service->getSpace($spaceId);

            return ToolResult::success($space);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
