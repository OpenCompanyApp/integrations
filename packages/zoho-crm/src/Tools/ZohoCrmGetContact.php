<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zoho CRM contact by ID.
 *
 * Returns the contact's fields and optionally limits the response to specific fields.
 */
class ZohoCrmGetContact implements Tool
{
    /**
     * @param  ZohoCrmService  $service  The Zoho CRM API client
     */
    public function __construct(
        private ZohoCrmService $service,
    ) {}

    public function name(): string
    {
        return 'zoho_crm_get_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Zoho CRM contact by its ID.
        Returns all contact fields by default, or specify a list of field API names to include.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM contact ID.'],
            'fields' => ['type' => 'array', 'description' => 'List of field API names to include in the response.'],
        ];
    }

    /**
     * Retrieve a Zoho CRM contact by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $contactId = $args['contact_id'] ?? '';
            if (empty($contactId)) {
                return ToolResult::error('contact_id is required.');
            }

            $fields = $args['fields'] ?? null;
            $result = $this->service->getContact($contactId, is_array($fields) ? $fields : null);

            $data = $result['data'] ?? [];

            return ToolResult::success([
                'data' => $data,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
