<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Mattermost user by ID.
 */
class MattermostGetUser implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_get_user';
    }

    public function description(): string
    {
        return 'Get a Mattermost user by their ID.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the user to retrieve.'],
        ];
    }

    /**
     * Get a Mattermost user by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $userId = $args['user_id'] ?? '';

            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }

            $result = $this->service->getUser($userId);

            return ToolResult::success([
                'ok' => true,
                'user' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
