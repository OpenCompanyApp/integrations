<?php

namespace OpenCompany\Integrations\Vbout\Tools;

use OpenCompany\Integrations\Vbout\VboutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VboutCreateContact implements Tool
{
    public function __construct(
        private VboutService $service,
    ) {}

    public function name(): string
    {
        return 'vbout_create_contact';
    }

    public function description(): string
    {
        return 'Add a new contact to a VBout email list. Requires an email address and a list ID. Optionally pass additional fields like first name, last name, or custom fields.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The contact\'s email address.'],
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The VBout list ID to add the contact to.'],
            'first_name' => ['type' => 'string', 'description' => 'Contact\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Contact\'s last name.'],
            'phone' => ['type' => 'string', 'description' => 'Contact\'s phone number.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('VBout integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('Email address is required.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('List ID is required.');
            }

            $extra = [];
            foreach (['first_name', 'last_name', 'phone'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $extra[$field] = $args[$field];
                }
            }

            $result = $this->service->createContact($args['email'], $args['list_id'], $extra);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
