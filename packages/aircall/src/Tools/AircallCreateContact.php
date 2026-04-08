<?php

namespace OpenCompany\Integrations\Aircall\Tools;

use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for creating a new contact in the Aircall API.
 *
 * Creates a contact with the provided details including name, company,
 * phone numbers, and email addresses. Returns the created contact with
 * its assigned ID.
 *
 * @see https://developer.aircall.io/api-references/#create-a-contact
 */
class AircallCreateContact implements Tool
{
    /**
     * Create a new AircallCreateContact tool instance.
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
        return 'aircall_create_contact';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Create a new contact in Aircall. Provide at least a first name or last name, and one phone number or email.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'First name of the contact.'],
            'last_name' => ['type' => 'string', 'description' => 'Last name of the contact.'],
            'company_name' => ['type' => 'string', 'description' => 'Company name associated with the contact.'],
            'information' => ['type' => 'string', 'description' => 'Additional notes or information about the contact.'],
            'phone_numbers' => ['type' => 'array', 'description' => 'Array of phone number objects, each with a "label" (e.g., "Work", "Mobile") and "value" (e.g., "+33612345678").'],
            'emails' => ['type' => 'array', 'description' => 'Array of email objects, each with a "label" (e.g., "Work", "Personal") and "value" (e.g., "john@example.com").'],
        ];
    }

    /**
     * Execute the create contact tool.
     *
     * @param  array  $args  The tool arguments containing contact fields.
     * @return ToolResult The result containing the created contact or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Aircall integration is not configured.');
            }

            $data = [];
            $dataKeys = ['first_name', 'last_name', 'company_name', 'information', 'phone_numbers', 'emails'];

            foreach ($dataKeys as $key) {
                if (isset($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
