<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * List commission types for a Tapfiliate program.
 *
 * Returns available commission type IDs that can be used in conversion and commission workflows.
 */
class TapfiliateListProgramCommissionTypes implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_list_program_commission_types';
    }

    public function description(): string
    {
        return 'List commission types for a Tapfiliate program.';
    }

    public function parameters(): array
    {
        return [
            'program_id' => ['type' => 'string', 'required' => true, 'description' => 'Program ID.'],
        ];
    }

    /**
     * List program commission types.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            return ToolResult::success($this->service->listProgramCommissionTypes((string) ($args['program_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
