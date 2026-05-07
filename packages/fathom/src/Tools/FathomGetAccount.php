<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Get the authenticated Fathom account profile.
 */
class FathomGetAccount implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_get_account';
    }

    public function description(): string
    {
        return 'Get the authenticated Fathom account profile from the documented /account endpoint.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get account details.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }

            return ToolResult::success($this->service->getAccount());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
