<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MailerSend\MailerSendService;

/**
 * Send a batch of emails through MailerSend's bulk email endpoint.
 */
class MailerSendSendBulkEmail implements Tool
{
    /**
     * @param  MailerSendService  $service  The MailerSend API client.
     */
    public function __construct(
        private MailerSendService $service,
    ) {}

    public function name(): string
    {
        return 'mailer_send_send_bulk_email';
    }

    public function description(): string
    {
        return 'Send multiple email payloads through the MailerSend bulk email endpoint.';
    }

    public function parameters(): array
    {
        return [
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of MailerSend email payloads.', 'items' => ['type' => 'object']],
        ];
    }

    /**
     * Send a MailerSend bulk email payload.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerSend integration is not configured.');
            }

            if (empty($args['messages']) || !is_array($args['messages'])) {
                return ToolResult::error('messages is required and must be an array.');
            }

            return ToolResult::success($this->service->sendBulkEmail($args['messages']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
