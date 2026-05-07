<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a personal RingCentral address book contact.
 */
class RingCentralUpdateContact extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_update_contact';
    }

    public function description(): string
    {
        return 'Update a RingCentral personal address book contact by contact ID.';
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Address book contact ID.'],
            'firstName' => ['type' => 'string', 'description' => 'First name.'],
            'lastName' => ['type' => 'string', 'description' => 'Last name.'],
            'company' => ['type' => 'string', 'description' => 'Company name.'],
            'email' => ['type' => 'string', 'description' => 'Email address.'],
            'businessPhone' => ['type' => 'string', 'description' => 'Business phone number.'],
            'mobilePhone' => ['type' => 'string', 'description' => 'Mobile phone number.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official contact fields.'],
        ];
    }

    /**
     * Update a contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['contact_id'])) {
                return ToolResult::error('contact_id is required.');
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['firstName', 'lastName', 'company', 'email', 'businessPhone', 'mobilePhone']));
            if ($payload === []) {
                return ToolResult::error('At least one contact field is required.');
            }

            return ToolResult::success($this->service->updateContact((string) $args['contact_id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
