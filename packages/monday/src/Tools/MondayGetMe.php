<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Monday.com user.
 *
 * Queries the `me` field to retrieve the authenticated user's
 * ID, name, and email address.
 */
class MondayGetMe implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_get_me';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Monday.com user.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $query = '{ me { id name email } }';

            $result = $this->service->graphql($query);

            return ToolResult::success($result['me'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
