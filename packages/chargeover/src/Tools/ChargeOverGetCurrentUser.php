<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Verify ChargeOver API access with a lightweight authenticated request.
 */
class ChargeOverGetCurrentUser implements Tool
{
    /**
     * @param  ChargeOverService  $service  The ChargeOver API client.
     */
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_get_current_user';
    }

    public function description(): string
    {
        return 'Verify ChargeOver API access with a lightweight authenticated customer query. ChargeOver does not expose a dedicated /me endpoint in REST API v3.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Verify API access through the ChargeOver API.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
