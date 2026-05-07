<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Delete a user from Vero.
 *
 * Removes the profile, properties, and activities for the user identifier.
 */
class VeroDeleteUser implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_delete_user';
    }

    public function description(): string
    {
        return 'Delete a Vero user by ID. This permanently removes profile properties and tracked activity.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier to delete.'],
        ];
    }

    /**
     * Execute the delete user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if ($id === '') {
                return ToolResult::error('User ID is required.');
            }

            $result = $this->service->deleteUser($id);

            return ToolResult::success([
                'id' => $id,
                'status' => $result['status'] ?? 200,
                'message' => $result['message'] ?? 'deleted',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
