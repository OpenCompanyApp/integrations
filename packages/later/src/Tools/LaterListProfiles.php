<?php

namespace OpenCompany\Integrations\Later\Tools;

use OpenCompany\Integrations\Later\LaterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all social media profiles connected to Later.
 *
 * Returns all social media accounts linked to the authenticated
 * user's Later account (e.g., Instagram, Twitter, Facebook, Pinterest, TikTok).
 */
class LaterListProfiles implements Tool
{
    public function __construct(
        private LaterService $service,
    ) {}

    public function name(): string
    {
        return 'later_list_profiles';
    }

    public function description(): string
    {
        return 'List all social media profiles connected to the Later account. Returns profile IDs, platform types, and display names.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of profiles to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Later integration is not configured.');
            }

            $result = $this->service->listProfiles(
                limit: $args['limit'] ?? null,
                page: $args['page'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
