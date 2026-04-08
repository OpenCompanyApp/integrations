<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new contact in ActiveCampaign.
 */
class ActiveCampaignCreateContact implements Tool
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
        return 'activecampaign_create_contact';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new contact in ActiveCampaign. Requires an email address; firstName, lastName, and phone are optional.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The contact email address.'],
            'firstName' => ['type' => 'string', 'description' => 'The contact first name.'],
            'lastName' => ['type' => 'string', 'description' => 'The contact last name.'],
            'phone' => ['type' => 'string', 'description' => 'The contact phone number.'],
        ];
    }

    /**
     * Execute the tool: create a contact in ActiveCampaign.
     *
     * @param  array     $args The tool arguments (email, firstName, lastName, phone).
     * @return ToolResult      The result containing the created contact or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('Email is required to create a contact.');
            }

            $result = $this->service->createContact(
                email: $email,
                firstName: $args['firstName'] ?? '',
                lastName: $args['lastName'] ?? '',
                phone: $args['phone'] ?? '',
            );

            $contact = $result['contact'] ?? $result;

            return ToolResult::success([
                'id' => (int) ($contact['id'] ?? 0),
                'email' => $contact['email'] ?? $email,
                'firstName' => $contact['firstName'] ?? '',
                'lastName' => $contact['lastName'] ?? '',
                'phone' => $contact['phone'] ?? '',
                'created' => $contact['createdTimestamp'] ?? $contact['cdate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
