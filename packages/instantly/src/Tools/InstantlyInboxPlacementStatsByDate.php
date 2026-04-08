<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get time series stats for inbox placement (inbox/spam/category distribution).
 */
class InstantlyInboxPlacementStatsByDate implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_inbox_placement_stats_by_date';
    }

    public function description(): string
    {
        return 'Get time series stats for inbox placement (inbox/spam/category distribution).';
    }

    public function parameters(): array
    {
        return [
            'test_id' => ['type' => 'string', 'required' => true, 'description' => 'Test ID'],
            'date_from' => ['type' => 'string', 'required' => false, 'description' => 'Start date'],
            'date_to' => ['type' => 'string', 'required' => false, 'description' => 'End date'],
            'recipient_geo' => ['type' => 'string', 'required' => false, 'description' => 'Geo filter'],
            'recipient_type' => ['type' => 'string', 'required' => false, 'description' => 'Type filter'],
            'recipient_esp' => ['type' => 'string', 'required' => false, 'description' => 'ESP filter'],
            'sender_email' => ['type' => 'string', 'required' => false, 'description' => 'Sender email filter'],
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

            $result = $body = ['test_id' => $args['test_id']]; foreach (['date_from','date_to','sender_email'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; foreach (['recipient_geo','recipient_type','recipient_esp'] as $k) if (isset($args[$k])) $body[$k] = array_map('intval', array_map('trim', explode(',', $args[$k]))); $this->service->getInboxPlacementStatsByDate($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
