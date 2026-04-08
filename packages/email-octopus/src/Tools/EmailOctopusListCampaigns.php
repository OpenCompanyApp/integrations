<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class EmailOctopusListCampaigns implements Tool
{
    public function __construct(
        private EmailOctopusService $service,
    ) {}

    public function name(): string
    {
        return 'emailoctopus_list_campaigns';
    }

    public function description(): string
    {
        return 'List all email campaigns in your EmailOctopus account, including their status, subject, and send dates.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of campaigns to return (default: 100, max: 100).'],
            'before' => ['type' => 'string', 'description' => 'Cursor for pagination — campaign ID to paginate before.'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — campaign ID to paginate after.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('EmailOctopus integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $result = $this->service->listCampaigns(
                limit: $limit,
                before: $args['before'] ?? null,
                after: $args['after'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
