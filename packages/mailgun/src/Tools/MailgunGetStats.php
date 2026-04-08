<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get total stats for the configured Mailgun domain.
 *
 * Supports filtering by event type, date range, and resolution.
 */
class MailgunGetStats implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_get_stats';
    }

    public function description(): string
    {
        return 'Get total stats for the Mailgun domain. Filter by event type, date range, and resolution (hour, day, month).';
    }

    public function parameters(): array
    {
        return [
            'event'      => ['type' => 'string', 'description' => 'Event type (e.g. accepted, delivered, failed, bounced).'],
            'start'      => ['type' => 'string', 'description' => 'Start date (RFC 2822 or Unix timestamp).'],
            'end'        => ['type' => 'string', 'description' => 'End date (RFC 2822 or Unix timestamp).'],
            'resolution' => ['type' => 'string', 'description' => 'Time resolution: hour, day, or month.'],
        ];
    }

    /**
     * Get total stats for the Mailgun domain.
     *
     * @param  array<string, mixed>  $args  Tool arguments (event, start, end, resolution)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $params = [];

            if (! empty($args['event'])) {
                $params['event'] = $args['event'];
            }
            if (! empty($args['start'])) {
                $params['start'] = $args['start'];
            }
            if (! empty($args['end'])) {
                $params['end'] = $args['end'];
            }
            if (! empty($args['resolution'])) {
                $params['resolution'] = $args['resolution'];
            }

            $result = $this->service->getStats($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
