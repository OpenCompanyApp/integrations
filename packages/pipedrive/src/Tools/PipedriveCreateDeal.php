<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new deal in Pipedrive CRM.
 *
 * Supports title, value, currency, person, organization, pipeline, and stage assignment.
 */
class PipedriveCreateDeal implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_create_deal';
    }

    public function description(): string
    {
        return 'Create a new deal in Pipedrive CRM. Requires at least a title. Optionally assign to a person, organization, pipeline, and stage.';
    }

    public function parameters(): array
    {
        return [
            'title'       => ['type' => 'string', 'required' => true, 'description' => 'Title of the deal.'],
            'value'       => ['type' => 'number', 'description' => 'Value of the deal.'],
            'currency'    => ['type' => 'string', 'description' => 'Currency code (e.g. USD, EUR).'],
            'person_id'   => ['type' => 'integer', 'description' => 'ID of the associated person.'],
            'org_id'      => ['type' => 'integer', 'description' => 'ID of the associated organization.'],
            'pipeline_id' => ['type' => 'integer', 'description' => 'ID of the pipeline to place the deal in.'],
            'stage_id'    => ['type' => 'integer', 'description' => 'ID of the stage to place the deal in.'],
        ];
    }

    /**
     * Create a new Pipedrive deal with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (title, value, currency, person_id, org_id, pipeline_id, stage_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $title = $args['title'] ?? '';
            if (empty($title)) {
                return ToolResult::error('title is required.');
            }

            $data = ['title' => $title];

            if (array_key_exists('value', $args)) {
                $data['value'] = $args['value'];
            }
            if (! empty($args['currency'])) {
                $data['currency'] = $args['currency'];
            }
            if (! empty($args['person_id'])) {
                $data['person_id'] = (int) $args['person_id'];
            }
            if (! empty($args['org_id'])) {
                $data['org_id'] = (int) $args['org_id'];
            }
            if (! empty($args['pipeline_id'])) {
                $data['pipeline_id'] = (int) $args['pipeline_id'];
            }
            if (! empty($args['stage_id'])) {
                $data['stage_id'] = (int) $args['stage_id'];
            }

            $result = $this->service->createDeal($data);
            $deal = $result['data'] ?? $result;

            return ToolResult::success($deal);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
