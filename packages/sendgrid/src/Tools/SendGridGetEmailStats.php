<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendgrid\SendgridService;

/**
 * Get email delivery statistics from SendGrid.
 */
class SendGridGetEmailStats implements Tool
{
    /** @param SendgridService $service The SendGrid API client */
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_get_email_stats';
    }

    public function description(): string
    {
        return <<<'MD'
        Get email delivery statistics from SendGrid. Returns metrics such as delivers,
        opens, clicks, bounces, and spam reports. Requires a start_date, optionally
        filtered by end_date and aggregated by day, week, or month.
        MD;
    }

    public function parameters(): array
    {
        return [
            'start_date' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Start date for the stats range in YYYY-MM-DD format.',
            ],
            'end_date' => [
                'type' => 'string',
                'description' => 'End date for the stats range in YYYY-MM-DD format.',
            ],
            'aggregated_by' => [
                'type' => 'string',
                'description' => 'Aggregation period: day, week, or month.',
                'enum' => ['day', 'week', 'month'],
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $startDate = $args['start_date'] ?? '';
            if (empty($startDate)) {
                return ToolResult::error('The "start_date" parameter is required.');
            }

            $result = $this->service->getEmailStats(
                startDate: $startDate,
                endDate: $args['end_date'] ?? null,
                aggregatedBy: $args['aggregated_by'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
