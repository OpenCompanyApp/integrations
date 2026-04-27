<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get daily account analytics breakdown.
 */
class InstantlyAnalyticsDailyAccount implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_analytics_daily_account';
    }

    public function description(): string
    {
        return 'Get daily account analytics breakdown.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'required' => false, 'description' => 'Start date (YYYY-MM-DD)'],
            'to' => ['type' => 'string', 'required' => false, 'description' => 'End date (YYYY-MM-DD)'],
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

            $params = []; foreach (['from','to'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $result = $this->service->getAnalyticsDailyAccount($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
