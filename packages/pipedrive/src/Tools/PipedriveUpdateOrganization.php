<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing organization in Pipedrive CRM.
 *
 * Supports updating name and address fields.
 */
class PipedriveUpdateOrganization implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_update_organization';
    }

    public function description(): string
    {
        return 'Update an existing organization in Pipedrive CRM. Provide the organization ID and at least one field to update.';
    }

    public function parameters(): array
    {
        return [
            'id'      => ['type' => 'integer', 'required' => true, 'description' => 'The Pipedrive organization ID.'],
            'name'    => ['type' => 'string', 'description' => 'Updated name of the organization.'],
            'address' => ['type' => 'string', 'description' => 'Updated physical address.'],
        ];
    }

    /**
     * Update a Pipedrive organization with the provided fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, address)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $data = [];

            if (array_key_exists('name', $args)) {
                $data['name'] = $args['name'];
            }
            if (array_key_exists('address', $args)) {
                $data['address'] = $args['address'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update is required (name, address).');
            }

            $result = $this->service->updateOrganization($id, $data);
            $org = $result['data'] ?? $result;

            return ToolResult::success($org);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
