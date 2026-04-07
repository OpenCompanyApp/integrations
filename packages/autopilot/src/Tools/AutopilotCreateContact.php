<?php

namespace OpenCompany\Integrations\Autopilot\Tools;

use OpenCompany\Integrations\Autopilot\AutopilotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a contact in Autopilot.
 */
class AutopilotCreateContact implements Tool
{
    public function __construct(
        private AutopilotService $service,
    ) {}

    public function name(): string
    {
        return 'autopilot_create_contact';
    }

    public function description(): string
    {
        return 'Create or update a contact in Autopilot. Requires an email address; other fields are optional.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The contact\'s email address.'],
            'first_name' => ['type' => 'string', 'description' => 'The contact\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'The contact\'s last name.'],
            'phone' => ['type' => 'string', 'description' => 'The contact\'s phone number.'],
            'title' => ['type' => 'string', 'description' => 'The contact\'s job title.'],
            'company' => ['type' => 'string', 'description' => 'The contact\'s company name.'],
            'custom_fields' => ['type' => 'object', 'description' => 'Custom field key-value pairs for the contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Autopilot integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            $data = ['Email' => $args['email']];

            if (!empty($args['first_name'])) {
                $data['FirstName'] = $args['first_name'];
            }
            if (!empty($args['last_name'])) {
                $data['LastName'] = $args['last_name'];
            }
            if (!empty($args['phone'])) {
                $data['Phone'] = $args['phone'];
            }
            if (!empty($args['title'])) {
                $data['Title'] = $args['title'];
            }
            if (!empty($args['company'])) {
                $data['Company'] = $args['company'];
            }
            if (!empty($args['custom_fields']) && is_array($args['custom_fields'])) {
                $data['custom'] = [];
                foreach ($args['custom_fields'] as $key => $value) {
                    $data['custom'][] = ['kind' => $key, 'value' => $value];
                }
            }

            $result = $this->service->createContact($data);

            return ToolResult::success([
                'message' => "Contact {$args['email']} created or updated.",
                'details' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
