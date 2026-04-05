<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Intercom contact.
 *
 * Supports updating name, email, phone, and custom attributes.
 */
class IntercomUpdateContact implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_update_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Intercom contact.
        Supports updating name, email, phone, and custom attributes.
        Returns the updated contact.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Intercom contact ID to update.'],
            'name' => ['type' => 'string', 'description' => 'Updated contact name.'],
            'email' => ['type' => 'string', 'description' => 'Updated contact email.'],
            'phone' => ['type' => 'string', 'description' => 'Updated contact phone number.'],
            'custom_attributes' => ['type' => 'object', 'description' => 'Custom attributes to update as key-value pairs.'],
        ];
    }

    /**
     * Update an Intercom contact with the provided fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id, name, email, phone, custom_attributes)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $id = $args['contact_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('contact_id is required.');
            }

            $data = [];

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (isset($args['phone'])) {
                $data['phone'] = $args['phone'];
            }
            if (isset($args['custom_attributes']) && is_array($args['custom_attributes'])) {
                $data['custom_attributes'] = $args['custom_attributes'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update is required.');
            }

            $result = $this->service->updateContact($id, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'email' => $result['email'] ?? '',
                'name' => $result['name'] ?? '',
                'phone' => $result['phone'] ?? '',
                'role' => $result['role'] ?? '',
                'custom_attributes' => $result['custom_attributes'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
