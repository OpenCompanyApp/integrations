<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Retrieve a Tapfiliate commission.
 *
 * Fetches commission details by numeric id.
 */
class TapfiliateGetCommission implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_get_commission';
    }

    public function description(): string
    {
        return 'Get a Tapfiliate commission by ID.';
    }

    public function parameters(): array
    {
        return [
            'commission_id' => ['type' => 'string', 'required' => true, 'description' => 'Commission ID.'],
        ];
    }

    /**
     * Get a commission.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            return ToolResult::success($this->service->getCommission((string) ($args['commission_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
