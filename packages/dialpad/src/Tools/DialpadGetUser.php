<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

use OpenCompany\Integrations\Dialpad\DialpadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Dialpad user by ID.
 */
class DialpadGetUser implements Tool
{
    public function __construct(
        private DialpadService $service,
    ) {}

    public function name(): string
    {
        return 'dialpad_get_user';
    }

    public function description(): string
    {
        return 'Get details of a specific Dialpad user by ID. Returns user profile including name, email, phone numbers, department, and status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Dialpad user ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dialpad integration is not configured.');
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
