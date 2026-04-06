<?php

namespace OpenCompany\Integrations\Brevo\Tools;

use OpenCompany\Integrations\Brevo\BrevoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BrevoCreateContact implements Tool
{
    public function __construct(
        private BrevoService $service,
    ) {}

    public function name(): string
    {
        return 'brevo_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Brevo. You can set attributes like first name and last name, and add the contact to one or more lists.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The email address for the new contact.'],
            'attributes' => ['type' => 'object', 'description' => 'Contact attributes such as {"FIRSTNAME": "John", "LASTNAME": "Doe"}. Keys must match attribute names in your Brevo account.'],
            'listIds' => ['type' => 'array', 'description' => 'Array of list IDs (integers) to add the contact to, e.g. [2, 5].'],
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

            $data = ['email' => $email];

            if (isset($args['attributes']) && is_array($args['attributes'])) {
                $data['attributes'] = $args['attributes'];
            }

            if (isset($args['listIds']) && is_array($args['listIds'])) {
                $data['listIds'] = array_map('intval', $args['listIds']);
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
