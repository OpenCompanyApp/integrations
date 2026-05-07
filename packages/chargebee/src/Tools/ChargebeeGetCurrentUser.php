<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to verify the configured Chargebee API credentials.
 *
 * Chargebee does not expose a current-user endpoint, so this tool makes a
 * one-item subscription list request and reports the decoded API response.
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
        return 'Verify Chargebee API connectivity with a lightweight subscriptions request. Use this to confirm credentials and site name are working.';
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
