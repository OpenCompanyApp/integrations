<?php

namespace OpenCompany\Integrations\Gorgias\Tools;

use OpenCompany\Integrations\Gorgias\GorgiasService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GorgiasCreateTicket implements Tool
{
    public function __construct(
        private GorgiasService $service,
    ) {}

    public function name(): string
    {
        return 'gorgias_create_ticket';
    }

    public function description(): string
    {
        return 'Create a new support ticket in Gorgias with a subject and body. Optionally specify sender, recipient, channel, and priority.';
    }

    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Ticket subject line.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Ticket body / message content (HTML supported).'],
            'from_email' => ['type' => 'string', 'description' => 'Sender email address.'],
            'to_email' => ['type' => 'string', 'description' => 'Recipient email address.'],
            'channel' => ['type' => 'string', 'description' => 'Ticket channel: email, chat, facebook, instagram, etc.'],
            'priority' => ['type' => 'string', 'description' => 'Ticket priority: normal, urgent, high, low.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gorgias integration is not configured.');
            }

            $result = $this->service->createTicket(
                subject: $args['subject'],
                body: $args['body'],
                fromEmail: $args['from_email'] ?? null,
                toEmail: $args['to_email'] ?? null,
                channel: $args['channel'] ?? null,
                priority: $args['priority'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
