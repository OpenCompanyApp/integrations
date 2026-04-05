<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * List emails from Resend with optional pagination.
 */
class ResendListEmails implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_list_emails';
    }

    public function description(): string
    {
        return <<<'MD'
        List emails from Resend. Supports pagination with a limit and cursor token.
        Returns an array of email objects and a pagination token for the next page.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type'        => 'integer',
                'description' => 'Maximum number of emails to return (default 100, max 100).',
            ],
            'token' => [
                'type'        => 'string',
                'description' => 'Cursor token for pagination — use the token from the previous response to get the next page.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Resend integration is not configured.');
            }

            $result = $this->service->listEmails(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                token: $args['token'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
