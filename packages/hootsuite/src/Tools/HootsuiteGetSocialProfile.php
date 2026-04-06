<?php

namespace OpenCompany\Integrations\Hootsuite\Tools;

use OpenCompany\Integrations\Hootsuite\HootsuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single social profile by ID in Hootsuite.
 *
 * Returns detailed information about a specific social media profile,
 * including type, display name, and account metadata.
 */
class HootsuiteGetSocialProfile implements Tool
{
    public function __construct(
        private HootsuiteService $service,
    ) {}

    public function name(): string
    {
        return 'hootsuite_get_social_profile';
    }

    public function description(): string
    {
        return 'Get details of a specific social media profile in Hootsuite by its ID. Returns profile type, display name, and account metadata.';
    }

    public function parameters(): array
    {
        return [
            'profileId' => ['type' => 'string', 'required' => true, 'description' => 'The social profile ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hootsuite integration is not configured.');
            }

            $result = $this->service->getSocialProfile($args['profileId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
