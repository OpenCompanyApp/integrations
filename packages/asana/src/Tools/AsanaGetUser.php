<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about an Asana user.
 */
class AsanaGetUser implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_get_user';
    }

    public function description(): string
    {
        return 'Get detailed information about an Asana user.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The user GID.'],
        ];
    }

    /**
     * Retrieve a user by their GID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $user = $this->service->getUser($id);

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
