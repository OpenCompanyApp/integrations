<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PostmarkListMessages implements Tool
{
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_list_messages';
    }

    public function description(): string
    {
        return 'List outbound email messages from Postmark. Supports filtering by recipient and delivery status, with pagination.';
    }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Number of messages to return (default: 100, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'recipient' => ['type' => 'string', 'description' => 'Filter by recipient email address.'],
            'status' => ['type' => 'string', 'description' => 'Filter by delivery status: "queued", "sent", "inbound", "processed", "delivered", "undelivered", "failed", "bounced", "held", "scheduled", "not embedded", "collapsed", "expired".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $count = isset($args['count']) ? min((int) $args['count'], 500) : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $recipient = $args['recipient'] ?? null;
            $status = $args['status'] ?? null;

            $result = $this->service->listMessages($count, $offset, $recipient, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
