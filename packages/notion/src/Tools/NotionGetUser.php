<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Notion user by their ID.
 */
class NotionGetUser implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_get_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Notion user by their ID. Returns the user's name, type,
        avatar URL, and email (if available).
        MD;
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the user to retrieve.'],
        ];
    }

    /**
     * Retrieve a user's name, type, avatar, and email by their ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
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
