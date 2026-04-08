<?php

namespace OpenCompany\Integrations\Hootsuite\Tools;

use OpenCompany\Integrations\Hootsuite\HootsuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List organization members in Hootsuite.
 *
 * Returns members of the authenticated user's Hootsuite organization,
 * including names, emails, and roles.
 */
class HootsuiteListMembers implements Tool
{
    public function __construct(
        private HootsuiteService $service,
    ) {}

    public function name(): string
    {
        return 'hootsuite_list_members';
    }

    public function description(): string
    {
        return 'List members of the Hootsuite organization. Returns member IDs, names, emails, and roles. Use limit to control page size.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of members to return.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hootsuite integration is not configured.');
            }

            $result = $this->service->listMembers(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
