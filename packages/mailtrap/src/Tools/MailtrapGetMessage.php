<?php

namespace OpenCompany\Integrations\Mailtrap\Tools;

use OpenCompany\Integrations\Mailtrap\MailtrapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailtrapGetMessage implements Tool
{
    public function __construct(
        private MailtrapService $service,
    ) {}

    public function name(): string
    {
        return 'mailtrap_get_message';
    }

    public function description(): string
    {
        return 'Get a single message from a Mailtrap inbox by its ID, including subject, sender, recipient, and body.';
    }

    public function parameters(): array
    {
        return [
            'inbox_id'  => ['type' => 'integer', 'required' => true, 'description' => 'The inbox ID.'],
            'message_id' => ['type' => 'integer', 'required' => true, 'description' => 'The message ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailtrap integration is not configured.');
            }

            $inboxId = $args['inbox_id'] ?? '';
            $messageId = $args['message_id'] ?? '';

            if (empty($inboxId)) {
                return ToolResult::error('The "inbox_id" parameter is required.');
            }
            if (empty($messageId)) {
                return ToolResult::error('The "message_id" parameter is required.');
            }

            $result = $this->service->getMessage($inboxId, $messageId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
