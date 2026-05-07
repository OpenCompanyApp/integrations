<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Retrieve a Tapfiliate conversion.
 *
 * Fetches one conversion by its numeric id.
 */
class TapfiliateGetConversion implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_get_conversion';
    }

    public function description(): string
    {
        return 'Get a Tapfiliate conversion by ID.';
    }

    public function parameters(): array
    {
        return [
            'conversion_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversion ID.'],
        ];
    }

    /**
     * Get a conversion.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            return ToolResult::success($this->service->getConversion((string) ($args['conversion_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
