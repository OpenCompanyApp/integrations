<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Move leads to a subsequence.
 */
class InstantlySubsequenceMoveLeads implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_subsequence_move_leads';
    }

    public function description(): string
    {
        return 'Move leads to a subsequence.';
    }

    public function parameters(): array
    {
        return [
            'lead_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated lead IDs'],
            'subsequence_id' => ['type' => 'string', 'required' => true, 'description' => 'Target subsequence ID'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $result = $this->service->subsequenceMoveLeads(['lead_ids' => array_map('trim', explode(',', $args['lead_ids'])), 'subsequence_id' => $args['subsequence_id']]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
