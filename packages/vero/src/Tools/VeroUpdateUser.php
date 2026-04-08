<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Update a user's profile data in Vero.
 *
 * Modifies an existing user's email address and/or custom attributes.
 * The user is identified by their unique ID.
 */
class VeroUpdateUser implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_update_user';
    }

    public function description(): string
    {
        return 'Update a user\'s profile in Vero. Pass the user ID, an optional new email, and a data object with attributes to update.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier to update.'],
            'email' => ['type' => 'string', 'description' => 'New email address for the user.'],
            'data' => ['type' => 'object', 'description' => 'Attributes to update as key-value pairs (e.g., {"plan": "enterprise", "company": "Acme Inc"}).'],
        ];
    }

    /**
     * Execute the update user tool.
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

            if (empty($id)) {
                return ToolResult::error('User ID is required.');
            }

            $email = $args['email'] ?? '';
            $data = $args['data'] ?? [];

            if (empty($email) && empty($data)) {
                return ToolResult::error('Provide at least an email or data to update.');
            }

            $result = $this->service->updateUser($id, $email, $data);

            return ToolResult::success([
                'id' => $id,
                'status' => $result['status'] ?? 'updated',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
