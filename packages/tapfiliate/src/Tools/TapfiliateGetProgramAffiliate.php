<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Retrieve a program affiliate record.
 *
 * Fetches coupon and enrollment data for an affiliate within a program.
 */
class TapfiliateGetProgramAffiliate implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_get_program_affiliate';
    }

    public function description(): string
    {
        return 'Get an affiliate enrollment within a Tapfiliate program.';
    }

    public function parameters(): array
    {
        return [
            'program_id' => ['type' => 'string', 'required' => true, 'description' => 'Program ID.'],
            'affiliate_id' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate ID.'],
        ];
    }

    /**
     * Get program affiliate.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            return ToolResult::success($this->service->getProgramAffiliate((string) ($args['program_id'] ?? ''), (string) ($args['affiliate_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
