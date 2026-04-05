<?php

namespace OpenCompany\Integrations\SendGrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SendGrid\SendGridService;

/**
 * List all SendGrid marketing lists.
 */
class SendGridListLists implements Tool
{
    /** @param SendGridService $service The SendGrid API client */
    public function __construct(
        private SendGridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_list_lists';
    }

    public function description(): string
    {
        return <<<'MD'
        List all marketing lists in the connected SendGrid account.
        Returns each list's ID, name, and contact count.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of lists to return.',
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

            $result = $this->service->listLists(
                limit: (int) ($args['limit'] ?? 100),
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
