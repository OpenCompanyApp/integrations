<?php

namespace OpenCompany\Integrations\Mailtrap\Tools;

use OpenCompany\Integrations\Mailtrap\MailtrapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailtrapGetInbox implements Tool
{
    public function __construct(
        private MailtrapService $service,
    ) {}

    public function name(): string
    {
        return 'mailtrap_get_inbox';
    }

    public function description(): string
    {
        return 'Get details for a specific Mailtrap inbox by ID, including its email address, settings, and message counts.';
    }

    public function parameters(): array
    {
        return [
            'inbox_id' => ['type' => 'integer', 'required' => true, 'description' => 'The inbox ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailtrap integration is not configured.');
            }

            $inboxId = $args['inbox_id'] ?? '';

            if (empty($inboxId)) {
                return ToolResult::error('The "inbox_id" parameter is required.');
            }

            $result = $this->service->getInbox($inboxId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
