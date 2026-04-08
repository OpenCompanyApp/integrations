<?php

namespace OpenCompany\Integrations\Actively\Tools;

use OpenCompany\Integrations\Actively\ActivelyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new campaign in Actively.
 *
 * Creates a campaign under the specified organization with a title, type,
 * start date, and end date. Returns the created campaign data including
 * its generated UUID.
 */
class ActivelyCreateCampaign implements Tool
{
    public function __construct(
        private ActivelyService $service,
    ) {}

    public function name(): string
    {
        return 'actively_create_campaign';
    }

    public function description(): string
    {
        return 'Create a new campaign for an organization in Actively. Specify the campaign title, type (e.g., "email", "social", "ads"), and the start and end dates.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'string', 'required' => true, 'description' => 'The organization UUID.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The campaign title.'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'The campaign type (e.g., "email", "social", "ads").'],
            'start_date' => ['type' => 'string', 'required' => true, 'description' => 'Campaign start date in ISO 8601 format (e.g., "2026-01-01").'],
            'end_date' => ['type' => 'string', 'required' => true, 'description' => 'Campaign end date in ISO 8601 format (e.g., "2026-03-31").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Actively integration is not configured.');
            }

            $result = $this->service->createCampaign(
                $args['org_id'],
                $args['title'],
                $args['type'],
                $args['start_date'],
                $args['end_date'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
