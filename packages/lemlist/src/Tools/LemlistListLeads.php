<?php

namespace OpenCompany\Integrations\Lemlist\Tools;

use OpenCompany\Integrations\Lemlist\LemlistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List leads in a Lemlist campaign.
 *
 * Returns a list of leads with their contact information and campaign status.
 */
class LemlistListLeads implements Tool
{
    public function __construct(
        private LemlistService $service,
    ) {}

    public function name(): string
    {
        return 'lemlist_list_leads';
    }

    public function description(): string
    {
        return 'List leads in a specific Lemlist campaign. Returns lead contact information, email status, and campaign progress.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the campaign to list leads for.'],
            'status' => ['type' => 'string', 'description' => 'Filter by lead status (e.g. "interested", "notInterested", "bounced", "sent", "replied").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of leads to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of leads to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemlist integration is not configured.');
            }

            if (empty($args['campaign_id'])) {
                return ToolResult::error('campaign_id is required.');
            }

            $params = [];
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listLeads($args['campaign_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
