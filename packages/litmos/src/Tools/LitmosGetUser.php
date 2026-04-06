<?php

namespace OpenCompany\Integrations\Litmos\Tools;

use OpenCompany\Integrations\Litmos\LitmosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Litmos user by ID.
 */
class LitmosGetUser implements Tool
{
    public function __construct(
        private LitmosService $service,
    ) {}

    public function name(): string
    {
        return 'litmos_get_user';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Litmos user by their ID, including profile data, course assignments, and team memberships.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Litmos user ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Litmos integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('User ID is required.');
            }

            $result = $this->service->getUser($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
