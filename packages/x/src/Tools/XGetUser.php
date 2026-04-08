<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\X\XService;

/**
 * Retrieve a Twitter user by their numeric ID.
 *
 * Returns the user's ID, name, and username. Additional fields
 * (profile image, description, metrics, etc.) can be requested
 * via the `user_fields` parameter.
 */
class XGetUser implements Tool
{
    /**
     * @param XService $service Injected Twitter API client
     */
    public function __construct(
        private XService $service,
    ) {}

    public function name(): string
    {
        return 'x_get_user';
    }

    public function description(): string
    {
        return 'Get a Twitter user by their numeric ID. Returns the user\'s name, username, and optionally their bio, profile image, and public metrics.';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The numeric Twitter user ID.',
            ],
            'user_fields' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'Additional user fields to request (e.g. "created_at", "description", "profile_image_url", "public_metrics", "verified"). Default: id, name, username.',
            ],
        ];
    }

    /**
     * Execute the tool: fetch a user by ID.
     *
     * @param array<string, mixed> $args Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured. Provide a Bearer token.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('User ID is required.');
            }

            $params = [];

            if (!empty($args['user_fields']) && is_array($args['user_fields'])) {
                $params['user.fields'] = implode(',', $args['user_fields']);
            }

            $result = $this->service->getUser($id, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
