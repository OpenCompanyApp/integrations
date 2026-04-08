<?php

namespace OpenCompany\Integrations\Mailjet\Tools;

use OpenCompany\Integrations\Mailjet\MailjetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailjetCreateContact implements Tool
{
    public function __construct(
        private MailjetService $service,
    ) {}

    public function name(): string
    {
        return 'mailjet_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Mailjet. Provide the email address to add.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The email address of the new contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailjet integration is not configured.');
            }

            $result = $this->service->createContact($args['email']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
