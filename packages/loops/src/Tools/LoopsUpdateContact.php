<?php

namespace OpenCompany\Integrations\Loops\Tools;

use OpenCompany\Integrations\Loops\LoopsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LoopsUpdateContact implements Tool
{
    public function __construct(
        private LoopsService $service,
    ) {}

    public function name(): string
    {
        return 'loops_update_contact';
    }

    public function description(): string
    {
        return 'Update an existing contact in Loops. Provide the contact ID and the fields to update (e.g., email, first_name, last_name, or custom properties).';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique contact ID to update.'],
            'email' => ['type' => 'string', 'description' => 'Updated email address.'],
            'first_name' => ['type' => 'string', 'description' => 'Updated first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Updated last name.'],
            'properties' => ['type' => 'object', 'description' => 'Custom properties to update as key-value pairs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Loops integration is not configured.');
            }

            if (empty($args['contact_id'])) {
                return ToolResult::error('contact_id is required.');
            }

            $fields = [];

            if (isset($args['email'])) {
                $fields['email'] = $args['email'];
            }

            if (isset($args['first_name'])) {
                $fields['first_name'] = $args['first_name'];
            }

            if (isset($args['last_name'])) {
                $fields['last_name'] = $args['last_name'];
            }

            if (isset($args['properties']) && is_array($args['properties'])) {
                foreach ($args['properties'] as $key => $value) {
                    $fields[$key] = $value;
                }
            }

            if (empty($fields)) {
                return ToolResult::error('At least one field must be provided to update.');
            }

            $result = $this->service->updateContact($args['contact_id'], $fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
