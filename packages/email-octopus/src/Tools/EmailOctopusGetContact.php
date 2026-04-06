<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class EmailOctopusGetContact implements Tool
{
    public function __construct(
        private EmailOctopusService $service,
    ) {}

    public function name(): string
    {
        return 'emailoctopus_get_contact';
    }

    public function description(): string
    {
        return 'Get details of a specific contact in an EmailOctopus mailing list, including email address, status, and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The contact ID to retrieve.'],
            'list_id' => ['type' => 'string', 'description' => 'The list ID the contact belongs to. Uses the default configured list if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('EmailOctopus integration is not configured.');
            }

            $result = $this->service->getContact(
                contactId: $args['contact_id'],
                listId: $args['list_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
