<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Deal.
 *
 * Retrieves a single deal by its ID, including all associated details
 * such as value, stage, person, organization, and custom fields.
 *
 * @see https://developers.pipedrive.com/docs/api/v1/Deals#getDeal
 */
class PipedriveGetDeal implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API service instance.
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'pipedrive_get_deal';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single deal in Pipedrive, including value, stage, person, organization, and custom fields.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The deal ID.'],
        ];
    }

    /**
     * Execute the get deal tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the deal ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Deal ID is required.');
            }

            $result = $this->service->getDeal((int) $id);

            return ToolResult::success($result['data'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
