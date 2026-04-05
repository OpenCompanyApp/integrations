<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing contact in ActiveCampaign.
 */
class ActiveCampaignUpdateContact implements Tool
{
    /**
     * @param ActiveCampaignService $service The ActiveCampaign service instance.
     */
    public function __construct(
        private ActiveCampaignService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'activecampaign_update_contact';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Update an existing contact in ActiveCampaign. Provide the contact ID and any fields to update (email, firstName, lastName, phone, or custom fields).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign contact ID to update.'],
            'email' => ['type' => 'string', 'description' => 'Updated email address.'],
            'firstName' => ['type' => 'string', 'description' => 'Updated first name.'],
            'lastName' => ['type' => 'string', 'description' => 'Updated last name.'],
            'phone' => ['type' => 'string', 'description' => 'Updated phone number.'],
            'fields' => ['type' => 'object', 'description' => 'Custom field values as key-value pairs (e.g., {"field[1]": "value"}).'],
        ];
    }

    /**
     * Execute the tool: update a contact in ActiveCampaign.
     *
     * @param  array     $args The tool arguments (contact_id and optional fields to update).
     * @return ToolResult      The result containing the updated contact or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $contactId = (int) ($args['contact_id'] ?? 0);
            if ($contactId <= 0) {
                return ToolResult::error('A valid contact_id is required.');
            }

            $data = [];
            foreach (['email', 'firstName', 'lastName', 'phone'] as $field) {
                if (isset($args[$field]) && $args[$field] !== '') {
                    $data[$field] = $args[$field];
                }
            }

            if (isset($args['fields']) && is_array($args['fields'])) {
                $data = array_merge($data, $args['fields']);
            }

            if (empty($data)) {
                return ToolResult::error('At least one field must be provided to update.');
            }

            $result = $this->service->updateContact($contactId, $data);
            $contact = $result['contact'] ?? $result;

            return ToolResult::success([
                'id' => (int) ($contact['id'] ?? $contactId),
                'email' => $contact['email'] ?? '',
                'firstName' => $contact['firstName'] ?? '',
                'lastName' => $contact['lastName'] ?? '',
                'phone' => $contact['phone'] ?? '',
                'updated' => $contact['updatedTimestamp'] ?? $contact['udate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
