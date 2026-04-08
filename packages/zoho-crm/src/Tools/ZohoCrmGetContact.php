<?php

namespace OpenCompany\Integrations\ZohoCrm\Tools;

use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zoho CRM contact by its ID.
 *
 * Returns the contact's full record including all populated fields.
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
        Returns the contact record with all populated fields.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Zoho CRM contact ID.'],
        ];
    }

    /**
     * Retrieve a Zoho CRM contact by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho CRM integration is not configured.');
            }

            $id = $args['contact_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('contact_id is required.');
            }

            $result = $this->service->getContact($id);
            $data = $result['data'] ?? [];

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
