<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a user by ID.
 *
 * Returns the user object including id, email, first_name, last_name,
 * type, status, timezone, and created_at.
 */
class ZoomGetUser implements Tool
{
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_get_user';
    }

    public function description(): string
    {
        return 'Get details of a specific Zoom user by ID or "me" for the authenticated user. Returns email, name, type, status, and timezone.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The user ID or "me" for the authenticated user.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $userId = $args['user_id'] ?? '';

            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }

            $result = $this->service->getUser($userId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
