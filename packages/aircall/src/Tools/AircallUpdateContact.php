<?php

namespace OpenCompany\Integrations\Aircall\Tools;

use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for updating an existing contact in the Aircall API.
 *
 * Updates the specified fields on an existing contact. Supports updating
 * name, company, notes, phone numbers, and email addresses.
 *
 * @see https://developer.aircall.io/api-references/#update-a-contact
 */
class AircallUpdateContact implements Tool
{
    /**
     * Create a new AircallUpdateContact tool instance.
     *
     * @param  AircallService  $service  The Aircall API service instance.
     */
    public function __construct(
        private AircallService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'aircall_update_contact';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Update an existing contact in Aircall. Provide the contact ID and the fields to update.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'integer', 'required' => true, 'description' => 'The unique identifier of the contact to update.'],
            'first_name' => ['type' => 'string', 'description' => 'Updated first name of the contact.'],
            'last_name' => ['type' => 'string', 'description' => 'Updated last name of the contact.'],
            'company_name' => ['type' => 'string', 'description' => 'Updated company name associated with the contact.'],
            'information' => ['type' => 'string', 'description' => 'Updated notes or information about the contact.'],
            'phone_numbers' => ['type' => 'array', 'description' => 'Updated array of phone number objects. Each must have "label" and "value". This replaces all existing phone numbers.'],
            'emails' => ['type' => 'array', 'description' => 'Updated array of email objects. Each must have "label" and "value". This replaces all existing emails.'],
        ];
    }

    /**
     * Execute the update contact tool.
     *
     * @param  array  $args  The tool arguments containing the contact ID and fields to update.
     * @return ToolResult The result containing the updated contact or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Aircall integration is not configured.');
            }

            $contactId = (int) $args['contact_id'];

            $data = [];
            $dataKeys = ['first_name', 'last_name', 'company_name', 'information', 'phone_numbers', 'emails'];

            foreach ($dataKeys as $key) {
                if (isset($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            $result = $this->service->updateContact($contactId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
