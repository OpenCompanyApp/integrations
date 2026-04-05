<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Zoom user by ID or email.
 *
 * Retrieves detailed user information including name, email,
 * type, and status.
 */
class ZoomGetUser implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_get_user';
    }

    public function description(): string
    {
        return 'Get details of a Zoom user by ID or email address.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID or email address.'],
        ];
    }

    /**
     * Retrieve a user by ID or email.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
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
