<?php

namespace OpenCompany\Integrations\Mailjet\Tools;

use OpenCompany\Integrations\Mailjet\MailjetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailjetGetStats implements Tool
{
    public function __construct(
        private MailjetService $service,
    ) {}

    public function name(): string
    {
        return 'mailjet_get_stats';
    }

    public function description(): string
    {
        return 'Get email statistics from the Mailjet statcounters endpoint. Returns send, delivery, open, click, and bounce counts.';
    }

    public function parameters(): array
    {
        return [
            'from_ts' => ['type' => 'string', 'description' => 'Start timestamp (ISO 8601 or Unix epoch) for the stats window.'],
            'to_ts' => ['type' => 'string', 'description' => 'End timestamp (ISO 8601 or Unix epoch) for the stats window.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of stat records to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailjet integration is not configured.');
            }

            $params = [];

            if (isset($args['from_ts'])) {
                $params['FromTS'] = $args['from_ts'];
            }

            if (isset($args['to_ts'])) {
                $params['ToTS'] = $args['to_ts'];
            }

            if (isset($args['limit'])) {
                $params['Limit'] = (int) $args['limit'];
            }

            if (isset($args['offset'])) {
                $params['Offset'] = (int) $args['offset'];
            }

            $result = $this->service->getStats($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
