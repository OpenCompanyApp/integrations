<?php

namespace OpenCompany\Integrations\Harvest\Tools;

use OpenCompany\Integrations\Harvest\HarvestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Harvest user by ID.
 */
class HarvestGetUser implements Tool
{
    /**
     * @param  HarvestService  $service  The Harvest API client
     */
    public function __construct(
        private HarvestService $service,
    ) {}

    public function name(): string
    {
        return 'harvest_get_user';
    }

    public function description(): string
    {
        return 'Get a single Harvest user by their ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The user ID.'],
        ];
    }

    /**
     * Retrieve a user by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Harvest integration is not configured.');
            }

            $id = $args['id'] ?? null;

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getUser((int) $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
