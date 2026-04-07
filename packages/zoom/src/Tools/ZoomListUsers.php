<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users in the Zoom account.
 *
 * Returns an array of user objects including id, email, first_name, last_name,
 * type, and status.
 */
class ZoomListUsers implements Tool
{
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_list_users';
    }

    public function description(): string
    {
        return 'List users in the Zoom account. Returns user IDs, emails, names, types (1=basic, 2=licensed), and status. Use this to find user IDs for other operations.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of users per page (1–300). Default: 30.'],
            'next_page_token' => ['type' => 'string', 'description' => 'Token for the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 30;
            $nextPageToken = $args['next_page_token'] ?? '';

            $result = $this->service->listUsers($pageSize, $nextPageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
