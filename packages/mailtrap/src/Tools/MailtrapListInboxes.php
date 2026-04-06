<?php

namespace OpenCompany\Integrations\Mailtrap\Tools;

use OpenCompany\Integrations\Mailtrap\MailtrapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailtrapListInboxes implements Tool
{
    public function __construct(
        private MailtrapService $service,
    ) {}

    public function name(): string
    {
        return 'mailtrap_list_inboxes';
    }

    public function description(): string
    {
        return 'List all inboxes in the Mailtrap account. Returns inbox IDs, names, and email addresses.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailtrap integration is not configured.');
            }

            $result = $this->service->listInboxes();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
