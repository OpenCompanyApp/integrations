<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in Intercom.
 *
 * Supports email, name, phone, role (user/lead), and custom attributes.
 */
class IntercomCreateContact implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_create_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new contact in Intercom.
        Supports email, name, phone, role ("user" or "lead"), and custom attributes.
        Returns the created contact with its Intercom ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'description' => 'Contact email address.'],
            'name' => ['type' => 'string', 'description' => 'Contact full name.'],
            'phone' => ['type' => 'string', 'description' => 'Contact phone number.'],
            'role' => ['type' => 'string', 'description' => 'Contact role: "user" or "lead".'],
            'custom_attributes' => ['type' => 'object', 'description' => 'Custom attributes as key-value pairs.'],
        ];
    }

    /**
     * Create a new Intercom contact with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (email, name, phone, role, custom_attributes)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $data = [];

            if (! empty($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (! empty($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (! empty($args['phone'])) {
                $data['phone'] = $args['phone'];
            }
            if (! empty($args['role'])) {
                $data['role'] = $args['role'];
            }
            if (isset($args['custom_attributes']) && is_array($args['custom_attributes'])) {
                $data['custom_attributes'] = $args['custom_attributes'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one contact field is required.');
            }

            $result = $this->service->createContact($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'email' => $result['email'] ?? '',
                'name' => $result['name'] ?? '',
                'role' => $result['role'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
