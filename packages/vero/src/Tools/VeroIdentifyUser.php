<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Identify (create or update) a user in Vero.
 *
 * Creates a new user profile or updates an existing one using Vero's
 * POST /users/track endpoint.
 */
class VeroIdentifyUser implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_identify_user';
    }

    public function description(): string
    {
        return 'Identify (create or update) a user in Vero. Pass a unique user ID, email, optional name, and any custom attributes in the data object. This creates the user if they don\'t exist, or updates their profile if they do.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier (e.g., database ID or UUID).'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'User email address.'],
            'name' => ['type' => 'string', 'description' => 'Display name for the user.'],
            'data' => ['type' => 'object', 'description' => 'Custom user attributes as key-value pairs (e.g., {"plan": "premium", "signup_date": "2025-01-15"}).'],
            'channels' => [
                'type' => 'array',
                'description' => 'Optional Vero channel objects, such as push tokens with type, address, and platform.',
                'items' => ['type' => 'object'],
            ],
        ];
    }

    /**
     * Execute the identify user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $id = $args['id'] ?? '';
            $email = $args['email'] ?? '';

            if (empty($id)) {
                return ToolResult::error('User ID is required.');
            }

            if (empty($email)) {
                return ToolResult::error('Email is required.');
            }

            $name = $args['name'] ?? '';
            $data = $args['data'] ?? [];

            $channels = $args['channels'] ?? [];
            $result = $this->service->identifyUser($id, $email, $name, $data, $channels);

            return ToolResult::success([
                'id' => $id,
                'email' => $email,
                'status' => $result['status'] ?? 200,
                'message' => $result['message'] ?? 'identified',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
