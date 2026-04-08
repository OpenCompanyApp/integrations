<?php

namespace OpenCompany\Integrations\Instagram\Tools;

use OpenCompany\Integrations\Instagram\InstagramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List insights (metrics) for the Instagram user account.
 *
 * Retrieves account-level performance metrics such as impressions,
 * reach, follower count, and profile views.
 */
class InstagramListInsights implements Tool
{
    public function __construct(
        private InstagramService $service,
    ) {}

    public function name(): string
    {
        return 'instagram_list_insights';
    }

    public function description(): string
    {
        return 'Get account-level insights and performance metrics for the authenticated Instagram user. Supports metrics like impressions, reach, follower count, and profile views with configurable time periods.';
    }

    public function parameters(): array
    {
        return [
            'metric' => [
                'type' => 'string',
                'description' => 'Comma-separated list of insight metrics (e.g. "impressions,reach,profile_views,follower_count").',
            ],
            'period' => [
                'type' => 'string',
                'description' => 'Aggregation period: "day", "week", "days_28", "month", or "lifetime". Defaults to "day".',
            ],
            'since' => [
                'type' => 'string',
                'description' => 'Start date for the insight data (UNIX timestamp or ISO date).',
            ],
            'until' => [
                'type' => 'string',
                'description' => 'End date for the insight data (UNIX timestamp or ISO date).',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instagram integration is not configured.');
            }

            $result = $this->service->listInsights(
                metric: $args['metric'] ?? null,
                period: $args['period'] ?? null,
                since: $args['since'] ?? null,
                until: $args['until'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
