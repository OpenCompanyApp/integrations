<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get deliverability insights for an inbox placement test.
 */
class InstantlyDeliverabilityInsights implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_deliverability_insights';
    }

    public function description(): string
    {
        return 'Get deliverability insights for an inbox placement test.';
    }

    public function parameters(): array
    {
        return [
            'test_id' => ['type' => 'string', 'required' => true, 'description' => 'Test ID'],
            'date_from' => ['type' => 'string', 'required' => false, 'description' => 'Start date'],
            'date_to' => ['type' => 'string', 'required' => false, 'description' => 'End date'],
            'previous_date_from' => ['type' => 'string', 'required' => false, 'description' => 'Previous start'],
            'previous_date_to' => ['type' => 'string', 'required' => false, 'description' => 'Previous end'],
            'show_previous' => ['type' => 'boolean', 'required' => false, 'description' => 'Show comparison'],
            'recipient_geo' => ['type' => 'string', 'required' => false, 'description' => 'Geo filter'],
            'recipient_type' => ['type' => 'string', 'required' => false, 'description' => 'Type filter'],
            'recipient_esp' => ['type' => 'string', 'required' => false, 'description' => 'ESP filter'],
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

            $result = $body = ['test_id' => $args['test_id']]; foreach (['date_from','date_to','previous_date_from','previous_date_to','show_previous'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; foreach (['recipient_geo','recipient_type','recipient_esp'] as $k) if (isset($args[$k])) $body[$k] = array_map('intval', array_map('trim', explode(',', $args[$k]))); $this->service->getDeliverabilityInsights($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
