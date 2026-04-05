<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Pipedrive deal by ID.
 *
 * Returns the deal's details including title, value, status, and associations.
 */
class PipedriveGetDeal implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_get_deal';
    }

    public function description(): string
    {
        return 'Retrieve a Pipedrive deal by its ID. Returns title, value, status, pipeline, stage, and associated contacts.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Pipedrive deal ID.'],
        ];
    }

    /**
     * Retrieve a Pipedrive deal by ID.
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

            $result = $this->service->getDeal($id);
            $deal = $result['data'] ?? $result;

            return ToolResult::success($deal);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
