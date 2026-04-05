<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing contact in Constant Contact.
 *
 * Updates a contact's fields such as first name, last name, email address,
 * and other properties. Only the fields provided in the update data will be changed.
 */
class ConstantContactUpdateContact implements Tool
{
    /**
     * Create a new ConstantContactUpdateContact tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_update_contact';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Update an existing contact\'s details in Constant Contact. Provide the contact ID and fields to update.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The Constant Contact contact ID to update.'],
            'first_name' => ['type' => 'string', 'description' => 'Updated first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Updated last name.'],
            'email_address' => ['type' => 'string', 'description' => 'Updated email address.'],
        ];
    }

    /**
     * Execute the tool: update a contact in Constant Contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            if (empty($args['contact_id'])) {
                return ToolResult::error('contact_id is required.');
            }

            $updateData = [];

            if (isset($args['first_name'])) {
                $updateData['first_name'] = $args['first_name'];
            }

            if (isset($args['last_name'])) {
                $updateData['last_name'] = $args['last_name'];
            }

            if (isset($args['email_address'])) {
                $updateData['email_address'] = ['address' => $args['email_address']];
            }

            if (empty($updateData)) {
                return ToolResult::error('At least one field to update must be provided.');
            }

            $result = $this->service->updateContact($args['contact_id'], $updateData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
