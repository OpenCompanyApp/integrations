<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\X\XService;

/**
 * Retrieve a Twitter user by their username (handle).
 *
 * Accepts a username without the @ prefix and returns the user's
 * profile data. Useful for resolving handles to IDs.
 */
class XGetUserByUsername implements Tool
{
    /**
     * @param XService $service Injected Twitter API client
     */
    public function __construct(
        private XService $service,
    ) {}

    public function name(): string
    {
        return 'x_get_user_by_username';
    }

    public function description(): string
    {
        return 'Get a Twitter user by their username (handle). Enter the username without the @ prefix. Returns the user\'s ID, name, username, and any additional requested fields.';
    }

    public function parameters(): array
    {
        return [
            'username' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Twitter username (handle) without the @ prefix (e.g. "elonmusk").',
            ],
            'user_fields' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'Additional user fields to request (e.g. "created_at", "description", "profile_image_url", "public_metrics", "verified"). Default: id, name, username.',
            ],
        ];
    }

    /**
     * Execute the tool: fetch a user by username.
     *
     * @param array<string, mixed> $args Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured. Provide a Bearer token.');
            }

            $username = $args['username'] ?? '';
            if (empty($username)) {
                return ToolResult::error('Username is required.');
            }

            // Strip leading @ if the user included it
            $username = ltrim($username, '@');

            $params = [];

            if (!empty($args['user_fields']) && is_array($args['user_fields'])) {
                $params['user.fields'] = implode(',', $args['user_fields']);
            }

            $result = $this->service->getUserByUsername($username, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
