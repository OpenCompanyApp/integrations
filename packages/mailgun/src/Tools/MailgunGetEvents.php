<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get events for the configured Mailgun domain.
 *
 * Supports filtering by event type, date range, limit, and recipient.
 */
class MailgunGetEvents implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_get_events';
    }

    public function description(): string
    {
        return 'Get events for the Mailgun domain. Filter by event type, date range, limit, and recipient.';
    }

    public function parameters(): array
    {
        return [
            'event'     => ['type' => 'string', 'description' => 'Event type to filter by (e.g. accepted, delivered, failed, bounced).'],
            'limit'     => ['type' => 'integer', 'description' => 'Maximum number of events to return (default 300, max 300).'],
            'begin'     => ['type' => 'string', 'description' => 'Start of time range (RFC 2822 or Unix timestamp).'],
            'end'       => ['type' => 'string', 'description' => 'End of time range (RFC 2822 or Unix timestamp).'],
            'recipient' => ['type' => 'string', 'description' => 'Filter by recipient email address.'],
        ];
    }

    /**
     * Get events for the Mailgun domain.
     *
     * @param  array<string, mixed>  $args  Tool arguments (event, limit, begin, end, recipient)
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
            if (! empty($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (! empty($args['begin'])) {
                $params['begin'] = $args['begin'];
            }
            if (! empty($args['end'])) {
                $params['end'] = $args['end'];
            }
            if (! empty($args['recipient'])) {
                $params['recipient'] = $args['recipient'];
            }

            $result = $this->service->getEvents($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
