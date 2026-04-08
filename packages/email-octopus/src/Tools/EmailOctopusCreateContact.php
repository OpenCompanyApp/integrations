<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class EmailOctopusCreateContact implements Tool
{
    public function __construct(
        private EmailOctopusService $service,
    ) {}

    public function name(): string
    {
        return 'emailoctopus_create_contact';
    }

    public function description(): string
    {
        return 'Add a new contact to an EmailOctopus mailing list. Requires an email address.';
    }

    public function parameters(): array
    {
        return [
            'email_address' => ['type' => 'string', 'required' => true, 'description' => 'The contact\'s email address.'],
            'list_id' => ['type' => 'string', 'description' => 'The list ID to add the contact to. Uses the default configured list if omitted.'],
            'first_name' => ['type' => 'string', 'description' => 'The contact\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'The contact\'s last name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('EmailOctopus integration is not configured.');
            }

            $fields = [];
            if (isset($args['first_name'])) {
                $fields['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $fields['last_name'] = $args['last_name'];
            }

            $result = $this->service->createContact(
                emailAddress: $args['email_address'],
                fields: $fields,
                listId: $args['list_id'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
