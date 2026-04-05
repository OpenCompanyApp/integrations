<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single contact by ID from ActiveCampaign.
 */
class ActiveCampaignGetContact implements Tool
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
        return 'activecampaign_get_contact';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific ActiveCampaign contact by ID, including email, name, phone, and custom fields.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign contact ID.'],
        ];
    }

    /**
     * Execute the tool: get a contact from ActiveCampaign.
     *
     * @param  array     $args The tool arguments (contact_id).
     * @return ToolResult      The result containing the contact or an error message.
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

            $result = $this->service->getContact($contactId);
            $contact = $result['contact'] ?? $result;

            return ToolResult::success([
                'id' => (int) ($contact['id'] ?? 0),
                'email' => $contact['email'] ?? '',
                'firstName' => $contact['firstName'] ?? '',
                'lastName' => $contact['lastName'] ?? '',
                'phone' => $contact['phone'] ?? '',
                'created' => $contact['createdTimestamp'] ?? $contact['cdate'] ?? null,
                'updated' => $contact['updatedTimestamp'] ?? $contact['udate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
