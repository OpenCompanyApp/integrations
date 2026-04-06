<?php

namespace OpenCompany\Integrations\Wise\Tools;

use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Wise profile.
 *
 * Retrieves profile information including type (personal/business), address,
 * and verification status.
 */
class WiseGetProfile implements Tool
{
    /**
     * Create a new WiseGetProfile instance.
     *
     * @param WiseService $service The Wise API service client.
     */
    public function __construct(
        private WiseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'wise_get_profile';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Get details of a specific Wise profile by ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'profile_id' => ['type' => 'integer', 'description' => 'The Wise profile ID.', 'required' => true],
        ];
    }

    /**
     * Execute the tool — get a profile by ID.
     *
     * @param array $args Tool arguments containing profile_id.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wise integration is not configured.');
            }

            $profileId = $args['profile_id'] ?? null;

            if (empty($profileId)) {
                return ToolResult::error('Parameter "profile_id" is required.');
            }

            $profile = $this->service->getProfile($profileId);

            return ToolResult::success($profile);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
