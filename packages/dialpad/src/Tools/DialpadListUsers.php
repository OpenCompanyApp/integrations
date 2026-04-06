<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

use OpenCompany\Integrations\Dialpad\DialpadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users in the Dialpad organization.
 *
 * Supports cursor-based pagination.
 */
class DialpadListUsers implements Tool
{
    public function __construct(
        private DialpadService $service,
    ) {}

    public function name(): string
    {
        return 'dialpad_list_users';
    }

    public function description(): string
    {
        return 'List users in the Dialpad organization. Returns user details including name, email, phone numbers, and department. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 50).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor — pass the cursor from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dialpad integration is not configured.');
            }

            $result = $this->service->listUsers(
                limit: isset($args['limit']) ? (int) $args['limit'] : 50,
                cursor: $args['cursor'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
