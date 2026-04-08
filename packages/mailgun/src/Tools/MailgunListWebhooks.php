<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailgunListWebhooks implements Tool
{
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_list_webhooks';
    }

    public function description(): string
    {
        return 'List all webhooks configured for a Mailgun domain.';
    }

    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'description' => 'The domain name to list webhooks for. Defaults to the configured sending domain.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $domainName = $args['domain'] ?? '';

            $result = $this->service->listWebhooks($domainName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
