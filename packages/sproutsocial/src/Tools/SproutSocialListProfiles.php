<?php

namespace OpenCompany\Integrations\SproutSocial\Tools;

use OpenCompany\Integrations\SproutSocial\SproutSocialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all social media profiles connected to Sprout Social.
 *
 * Returns all social media accounts linked to the authenticated
 * user's Sprout Social account (e.g., Twitter, Facebook, LinkedIn, Instagram).
 */
class SproutSocialListProfiles implements Tool
{
    public function __construct(
        private SproutSocialService $service,
    ) {}

    public function name(): string
    {
        return 'sproutsocial_list_profiles';
    }

    public function description(): string
    {
        return 'List all social media profiles connected to the Sprout Social account. Returns profile IDs, service types (e.g., Twitter, Facebook, LinkedIn), and display names.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sprout Social integration is not configured.');
            }

            $result = $this->service->listProfiles();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
