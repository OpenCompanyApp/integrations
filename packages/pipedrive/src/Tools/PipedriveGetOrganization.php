<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Pipedrive organization by ID.
 *
 * Returns the organization's details including name and address.
 */
class PipedriveGetOrganization implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_get_organization';
    }

    public function description(): string
    {
        return 'Retrieve a Pipedrive organization by its ID. Returns name, address, and other details.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Pipedrive organization ID.'],
        ];
    }

    /**
     * Retrieve a Pipedrive organization by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
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

            $result = $this->service->getOrganization($id);
            $org = $result['data'] ?? $result;

            return ToolResult::success($org);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
