<?php

namespace OpenCompany\Integrations\SproutSocial\Tools;

use OpenCompany\Integrations\SproutSocial\SproutSocialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single social media profile by ID in Sprout Social.
 *
 * Returns detailed information about a specific social media profile,
 * including service type, display name, and account metadata.
 */
class SproutSocialGetProfile implements Tool
{
    public function __construct(
        private SproutSocialService $service,
    ) {}

    public function name(): string
    {
        return 'sproutsocial_get_profile';
    }

    public function description(): string
    {
        return 'Get details of a specific social media profile in Sprout Social by its ID. Returns profile service type, display name, and account metadata.';
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
                return ToolResult::error('Sprout Social integration is not configured.');
            }

            $result = $this->service->getProfile($args['profileId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
