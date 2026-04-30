<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendgrid\SendgridService;

/**
 * List all verified sender identities in SendGrid.
 */
class SendGridListSenderIdentities implements Tool
{
    /** @param SendgridService $service The SendGrid API client */
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_list_sender_identities';
    }

    public function description(): string
    {
        return <<<'MD'
        List all verified sender identities in the connected SendGrid account.
        Returns each sender's ID, nickname, email address, and verification status.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $result = $this->service->listSenderIdentities();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
