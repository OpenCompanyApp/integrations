<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Create a campaign from a shared/exported campaign.
 */
class InstantlyCreateCampaignFromExport implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_campaign_from_export';
    }

    public function description(): string
    {
        return 'Create a new campaign from a shared/exported campaign ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Shared/exported campaign ID'],
        ];
    }

    /**
     * Create a campaign from an export.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            return ToolResult::success($this->service->createCampaignFromExport($args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
