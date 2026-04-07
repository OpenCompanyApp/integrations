<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailgunListMessages implements Tool
{
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_list_messages';
    }

    public function description(): string
    {
        return 'List message events in your Mailgun domain with optional filtering and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of events to return (default: 300, max: 300).'],
            'page' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'event' => ['type' => 'string', 'description' => 'Filter by event type (e.g., "stored", "delivered", "failed", "rejected").'],
            'begin' => ['type' => 'string', 'description' => 'Start of time range in RFC 2822 or epoch format.'],
            'end' => ['type' => 'string', 'description' => 'End of time range in RFC 2822 or epoch format.'],
            'ascending' => ['type' => 'boolean', 'description' => 'Sort results in ascending order (default: no / descending).'],
            'recipient' => ['type' => 'string', 'description' => 'Filter by recipient email address.'],
            'subject' => ['type' => 'string', 'description' => 'Filter by email subject.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $params = array_filter([
                'limit' => $args['limit'] ?? null,
                'page' => $args['page'] ?? null,
                'event' => $args['event'] ?? null,
                'begin' => $args['begin'] ?? null,
                'end' => $args['end'] ?? null,
                'ascending' => $args['ascending'] ?? null,
                'recipient' => $args['recipient'] ?? null,
                'subject' => $args['subject'] ?? null,
            ], fn($value) => $value !== null);

            $result = $this->service->listMessages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
