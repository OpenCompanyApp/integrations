<?php

namespace OpenCompany\Integrations\Brevo\Tools;

use OpenCompany\Integrations\Brevo\BrevoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BrevoGetContact implements Tool
{
    public function __construct(
        private BrevoService $service,
    ) {}

    public function name(): string
    {
        return 'brevo_get_contact';
    }

    public function description(): string
    {
        return 'Get details of a specific contact in Brevo by their email address. Returns contact attributes, list memberships, and creation date.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The email address of the contact to retrieve (used as the contact identifier in Brevo).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brevo integration is not configured.');
            }

            $email = $args['email'] ?? '';

            if (empty($email)) {
                return ToolResult::error('Email address is required.');
            }

            $result = $this->service->getContact($email);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
