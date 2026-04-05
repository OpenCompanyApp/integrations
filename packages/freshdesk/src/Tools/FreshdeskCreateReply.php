<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a public reply on a support ticket.
 */
class FreshdeskCreateReply implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_create_reply';
    }

    public function description(): string
    {
        return 'Post a public reply to a support ticket. The reply is visible to the requester. Use this to respond to customers.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to reply to.'],
            'body'      => ['type' => 'string', 'required' => true, 'description' => 'HTML body of the reply.'],
            'cc_emails' => ['type' => 'array', 'description' => 'Array of email addresses to CC on the reply.'],
            'bcc_emails' => ['type' => 'array', 'description' => 'Array of email addresses to BCC.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            $ticketId = (int) ($args['ticket_id'] ?? 0);
            if ($ticketId <= 0) {
                return ToolResult::error('ticket_id is required and must be a positive integer.');
            }

            if (empty($args['body'])) {
                return ToolResult::error('body is required.');
            }

            $data = array_filter([
                'body'       => $args['body'],
                'cc_emails'  => $args['cc_emails'] ?? null,
                'bcc_emails' => $args['bcc_emails'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->createReply($ticketId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
