<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve an Intercom contact by ID.
 *
 * Returns the contact's ID, email, name, phone, role, and custom attributes.
 */
class IntercomGetContact implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_get_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve an Intercom contact by its ID.
        Returns the contact's ID, email, name, phone, role, and custom attributes.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Intercom contact ID.'],
        ];
    }

    /**
     * Retrieve an Intercom contact by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id)
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

            $result = $this->service->getContact($id);

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
