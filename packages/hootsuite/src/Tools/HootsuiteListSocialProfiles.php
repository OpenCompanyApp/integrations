<?php

namespace OpenCompany\Integrations\Hootsuite\Tools;

use OpenCompany\Integrations\Hootsuite\HootsuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List social profiles connected in Hootsuite.
 *
 * Returns all social media profiles linked to the authenticated
 * user's Hootsuite account (e.g., Twitter, Facebook, LinkedIn, Instagram).
 */
class HootsuiteListSocialProfiles implements Tool
{
    public function __construct(
        private HootsuiteService $service,
    ) {}

    public function name(): string
    {
        return 'hootsuite_list_social_profiles';
    }

    public function description(): string
    {
        return 'List all social media profiles connected to the Hootsuite account. Returns profile IDs, types (e.g., Twitter, Facebook, LinkedIn), and display names.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hootsuite integration is not configured.');
            }

            $result = $this->service->listSocialProfiles();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
