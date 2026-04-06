<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve the current authenticated user from Chargebee.
 *
 * Calls GET /v2/users/me to verify credentials and return user information.
 */
class ChargebeeGetCurrentUser implements Tool
{
    /**
     * Create a new ChargebeeGetCurrentUser tool instance.
     *
     * @param  ChargebeeService  $service  The Chargebee API service.
     */
    public function __construct(
        private ChargebeeService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chargebee_get_current_user';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Retrieve the current authenticated user information from Chargebee. Use this to verify credentials are working and check user details.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
