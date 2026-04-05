<?php

namespace OpenCompany\Integrations\SendGrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SendGrid\SendGridService;

/**
 * List marketing contacts from SendGrid.
 */
class SendGridListContacts implements Tool
{
    /** @param SendGridService $service The SendGrid API client */
    public function __construct(
        private SendGridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_list_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        List marketing contacts from SendGrid. Returns contact records with IDs, emails,
        names, and custom fields. Use the limit parameter to control page size.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of contacts to return.',
                'default' => 100,
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $result = $this->service->listContacts(
                limit: (int) ($args['limit'] ?? 100),
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
