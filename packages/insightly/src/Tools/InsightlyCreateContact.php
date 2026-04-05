<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Contact
 *
 * Creates a new contact in Insightly CRM.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/PostEntity
 */
class InsightlyCreateContact implements Tool
{
    /**
     * Create a new InsightlyCreateContact tool instance.
     *
     * @param  InsightlyService  $service  The Insightly API service.
     */
    public function __construct(
        private InsightlyService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'insightly_create_contact';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Create a new contact in Insightly CRM. Provide contact details such as first name, last name, email, phone, and other fields. Returns the created contact with its new ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'First name of the contact.'],
            'last_name' => ['type' => 'string', 'description' => 'Last name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Primary email address.'],
            'phone' => ['type' => 'string', 'description' => 'Primary phone number.'],
            'title' => ['type' => 'string', 'description' => 'Job title.'],
            'background' => ['type' => 'string', 'description' => 'Background notes or description.'],
            'contact_type' => ['type' => 'string', 'description' => 'Contact type (e.g., "Customer", "Partner", "Vendor"). Must match a type defined in Insightly.'],
            'additional_fields' => ['type' => 'object', 'description' => 'Additional Insightly contact fields as key-value pairs (e.g., {"CONTACTTYPE": "Customer", "INDUSTRY": "Technology"}).'],
        ];
    }

    /**
     * Execute the create contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments with contact fields.
     * @return ToolResult The created contact record or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            $data = [];

            if (isset($args['first_name'])) {
                $data['FIRST_NAME'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['LAST_NAME'] = $args['last_name'];
            }
            if (isset($args['title'])) {
                $data['TITLE'] = $args['title'];
            }
            if (isset($args['background'])) {
                $data['BACKGROUND'] = $args['background'];
            }
            if (isset($args['contact_type'])) {
                $data['CONTACTTYPE'] = $args['contact_type'];
            }

            // Build email address record
            if (isset($args['email'])) {
                $data['EMAIL_ADDRESS'] = $args['email'];
            }

            // Build phone record
            if (isset($args['phone'])) {
                $data['PHONE'] = $args['phone'];
            }

            // Merge any additional fields
            if (isset($args['additional_fields']) && is_array($args['additional_fields'])) {
                $data = array_merge($data, $args['additional_fields']);
            }

            if (empty($data)) {
                return ToolResult::error('At least one contact field must be provided.');
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
