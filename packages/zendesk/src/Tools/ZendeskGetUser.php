<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zendesk user by ID.
 *
 * Returns the user's ID, name, email, role, and profile details.
 */
class ZendeskGetUser implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_get_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Zendesk user by its ID.
        Returns the user's ID, name, email, role, and profile details.
        MD;
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Zendesk user ID.'],
        ];
    }

    /**
     * Retrieve a Zendesk user by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $id = $args['user_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('user_id is required.');
            }

            $result = $this->service->getUser($id);

            $user = $result['user'] ?? $result;

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
