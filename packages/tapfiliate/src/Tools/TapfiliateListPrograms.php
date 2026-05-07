<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * List Tapfiliate programs.
 *
 * Returns affiliate programs configured in the Tapfiliate account.
 */
class TapfiliateListPrograms implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_list_programs';
    }

    public function description(): string
    {
        return 'List Tapfiliate affiliate programs.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List programs.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            return ToolResult::success($this->service->listPrograms());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
