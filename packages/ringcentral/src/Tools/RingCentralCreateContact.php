<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a personal RingCentral address book contact.
 */
class RingCentralCreateContact extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_create_contact';
    }

    public function description(): string
    {
        return 'Create a contact in the authenticated RingCentral extension\'s personal address book.';
    }

    public function parameters(): array
    {
        return [
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
     * Create a contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['firstName', 'lastName', 'company', 'email', 'businessPhone', 'mobilePhone']));
            if ($payload === []) {
                return ToolResult::error('At least one contact field is required.');
            }

            return ToolResult::success($this->service->createContact($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
