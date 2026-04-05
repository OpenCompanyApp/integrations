<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new organization in Pipedrive CRM.
 *
 * Supports name, address, and owner assignment.
 */
class PipedriveCreateOrganization implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_create_organization';
    }

    public function description(): string
    {
        return 'Create a new organization in Pipedrive CRM. Requires at least a name.';
    }

    public function parameters(): array
    {
        return [
            'name'      => ['type' => 'string', 'required' => true, 'description' => 'Name of the organization.'],
            'address'   => ['type' => 'string', 'description' => 'Physical address of the organization.'],
            'owner_id'  => ['type' => 'integer', 'description' => 'ID of the user who will own this organization.'],
        ];
    }

    /**
     * Create a new Pipedrive organization with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, address, owner_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (! empty($args['address'])) {
                $data['address'] = $args['address'];
            }
            if (! empty($args['owner_id'])) {
                $data['owner_id'] = (int) $args['owner_id'];
            }

            $result = $this->service->createOrganization($data);
            $org = $result['data'] ?? $result;

            return ToolResult::success($org);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
