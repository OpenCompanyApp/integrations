<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a HubSpot contact by ID.
 *
 * Permanently removes the contact from HubSpot CRM.
 */
class HubSpotDeleteContact implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_delete_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a HubSpot contact by ID.
        Permanently removes the contact from HubSpot CRM.
        This action cannot be undone.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'HubSpot contact ID to delete.'],
        ];
    }

    /**
     * Delete a HubSpot contact permanently by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $this->service->deleteContact($id);

            return ToolResult::success([
                'id' => $id,
                'deleted' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
