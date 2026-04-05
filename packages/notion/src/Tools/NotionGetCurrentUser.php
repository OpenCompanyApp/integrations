<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about the current Notion integration bot user.
 */
class NotionGetCurrentUser implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get information about the current integration bot user.
        Returns the bot's name, avatar, and workspace info.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the current integration bot user's name, avatar, and workspace info.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'type' => $result['type'] ?? '',
                'bot' => $result['bot'] ?? [],
                'avatar_url' => $result['avatar_url'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
