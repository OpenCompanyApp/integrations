<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Add custom variables to an Instantly campaign.
 */
class InstantlyAddCampaignVariables implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_add_campaign_variables';
    }

    public function description(): string
    {
        return 'Add custom variables to an existing campaign.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID'],
            'variables' => ['type' => 'array', 'required' => true, 'description' => 'Variable names to add to the campaign', 'items' => ['type' => 'string']],
        ];
    }

    /**
     * Add campaign variables.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $variables = $args['variables'];
            if (is_string($variables)) {
                $variables = array_filter(array_map('trim', explode(',', $variables)));
            }

            return ToolResult::success($this->service->addCampaignVariables($args['id'], ['variables' => $variables]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
