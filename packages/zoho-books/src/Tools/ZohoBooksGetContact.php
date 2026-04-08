<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_get_contact
 *
 * Retrieves full details of a specific contact (customer or vendor)
 * by its ID, including billing/shipping addresses and contact persons.
 */
class ZohoBooksGetContact implements Tool
{
    /**
     * @param  ZohoBooksService  $service  The Zoho Books API service instance.
     */
    public function __construct(
        private ZohoBooksService $service,
    ) {}

    /**
     * The tool identifier used by the AI agent runtime.
     */
    public function name(): string
    {
        return 'zohobooks_get_contact';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details of a specific contact (customer or vendor) in Zoho Books, including addresses and contact persons.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the contact to retrieve.'],
        ];
    }

    /**
     * Execute the tool call — get a single contact from Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
            }

            $contactId = $args['contact_id'] ?? '';
            if (empty($contactId)) {
                return ToolResult::error('contact_id is required.');
            }

            $result = $this->service->getContact($contactId);
            $contact = $result['contact'] ?? $result;

            return ToolResult::success($contact);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
