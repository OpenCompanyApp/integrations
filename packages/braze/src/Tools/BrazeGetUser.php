<?php

namespace OpenCompany\Integrations\Braze\Tools;

use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single user profile from Braze by external ID.
 *
 * Returns the full user profile including attributes, custom attributes,
 * events, purchases, and subscription groups.
 *
 * @see https://www.braze.com/docs/api/endpoints/export/user_data/post_users_export/
 */
class BrazeGetUser implements Tool
{
    public function __construct(
        private BrazeService $service,
    ) {}

    public function name(): string
    {
        return 'braze_get_user';
    }

    public function description(): string
    {
        return 'Get a single user profile from Braze by their external ID. Returns full profile data including attributes, custom attributes, events, purchases, and subscription groups.';
    }

    public function parameters(): array
    {
        return [
            'external_ids' => ['type' => 'array', 'required' => true, 'description' => 'Array of one or more external user IDs to look up (e.g., ["user-123"]).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braze integration is not configured.');
            }

            $externalIds = $args['external_ids'] ?? null;

            if (empty($externalIds) || !is_array($externalIds)) {
                return ToolResult::error('external_ids must be a non-empty array of user IDs.');
            }

            $result = $this->service->exportUsers($externalIds, null, 1);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
