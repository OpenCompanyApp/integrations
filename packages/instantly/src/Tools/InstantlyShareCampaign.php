<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Share a campaign for cloning by other users.
 *
 * Instantly shares campaigns for a limited period and may return an empty
 * response body on success.
 */
class InstantlyShareCampaign implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_share_campaign';
    }

    public function description(): string
    {
        return 'Share a campaign so other users can create a new campaign from it.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID'],
        ];
    }

    /**
     * Share a campaign.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            return ToolResult::success($this->service->shareCampaign($args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
