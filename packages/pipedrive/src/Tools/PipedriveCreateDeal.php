<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Deal.
 *
 * Creates a new deal in Pipedrive with a title and optional fields such as
 * value, currency, person_id, org_id, stage_id, and more.
 *
 * @see https://developers.pipedrive.com/docs/api/v1/Deals#addDeal
 */
class PipedriveCreateDeal implements Tool
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
        return 'pipedrive_create_deal';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Create a new deal in Pipedrive. Provide a title and optionally set value, currency, person, organization, stage, and other deal fields.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'title'       => ['type' => 'string', 'required' => true, 'description' => 'The deal title.'],
            'value'       => ['type' => 'number', 'description' => 'The deal value (numeric).'],
            'currency'    => ['type' => 'string', 'description' => 'Deal currency code (e.g., "USD", "EUR").'],
            'person_id'   => ['type' => 'integer', 'description' => 'ID of the person associated with this deal.'],
            'org_id'      => ['type' => 'integer', 'description' => 'ID of the organization associated with this deal.'],
            'stage_id'    => ['type' => 'integer', 'description' => 'ID of the pipeline stage to place the deal in.'],
            'pipeline_id' => ['type' => 'integer', 'description' => 'ID of the pipeline. Omit for the default pipeline.'],
            'status'      => ['type' => 'string', 'description' => 'Deal status: "open" (default), "won", or "lost".'],
            'probability' => ['type' => 'number', 'description' => 'Deal success probability (0–100).'],
            'note'        => ['type' => 'string', 'description' => 'Note to attach to the deal.'],
        ];
    }

    /**
     * Execute the create deal tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (title, value, currency, etc.).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $title = $args['title'] ?? '';
            if (empty($title)) {
                return ToolResult::error('Deal title is required.');
            }

            $extra = [];
            foreach (['value', 'currency', 'person_id', 'org_id', 'stage_id', 'pipeline_id', 'status', 'probability', 'note'] as $key) {
                if (isset($args[$key])) {
                    $extra[$key] = $args[$key];
                }
            }

            $result = $this->service->createDeal($title, $extra);

            return ToolResult::success($result['data'] ?? $result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
