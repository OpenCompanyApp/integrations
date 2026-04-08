<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\Integrations\Sendgrid\SendgridService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SendgridGetContact implements Tool
{
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_get_contact';
    }

    public function description(): string
    {
        return 'Get details of a specific contact in SendGrid by their contact ID. Returns email, custom fields, and list memberships.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the contact to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
