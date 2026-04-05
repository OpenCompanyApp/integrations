<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\X\XService;

/**
 * Retrieve the currently authenticated user's profile.
 *
 * Uses the Bearer token (or OAuth 2.0 user context) to identify
 * the calling user and returns their profile data.
 */
class XGetCurrentUser implements Tool
{
    /**
     * @param XService $service Injected Twitter API client
     */
    public function __construct(
        private XService $service,
    ) {}

    public function name(): string
    {
        return 'x_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s own profile. Returns your user ID, name, and username, plus any additional requested fields.';
    }

    public function parameters(): array
    {
        return [
            'user_fields' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'Additional user fields to request (e.g. "created_at", "description", "profile_image_url", "public_metrics", "verified"). Default: id, name, username.',
            ],
        ];
    }

    /**
     * Execute the tool: fetch the authenticated user's profile.
     *
     * @param array<string, mixed> $args Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured. Provide a Bearer token.');
            }

            $params = [];

            if (!empty($args['user_fields']) && is_array($args['user_fields'])) {
                $params['user.fields'] = implode(',', $args['user_fields']);
            }

            $result = $this->service->getCurrentUser($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
