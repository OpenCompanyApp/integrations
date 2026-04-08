<?php

namespace OpenCompany\Integrations\Facebook\Tools;

use OpenCompany\Integrations\Facebook\FacebookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FacebookListInsights implements Tool
{
    public function __construct(
        private FacebookService $service,
    ) {}

    public function name(): string
    {
        return 'facebook_list_insights';
    }

    public function description(): string
    {
        return 'Get engagement and performance metrics (insights) for a Facebook Page. Supports metrics like page_impressions, page_engaged_users, page_post_engagements, and more.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Facebook Page ID.',
            ],
            'metric' => [
                'type' => 'string',
                'description' => 'Comma-separated list of insight metrics to retrieve (e.g. "page_impressions,page_engaged_users,page_post_engagements"). Omit to return all available metrics.',
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
                return ToolResult::error('Facebook integration is not configured.');
            }

            if (empty($args['page_id'])) {
                return ToolResult::error('page_id is required.');
            }

            $params = [];

            if (isset($args['metric'])) {
                $params['metric'] = $args['metric'];
            }

            if (isset($args['period'])) {
                $params['period'] = $args['period'];
            } else {
                $params['period'] = 'day';
            }

            if (isset($args['since'])) {
                $params['since'] = $args['since'];
            }

            if (isset($args['until'])) {
                $params['until'] = $args['until'];
            }

            $result = $this->service->listInsights($args['page_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
