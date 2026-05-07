<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a campaign.
 */
class ActiveCampaignGetCampaign extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_get_campaign'; }
    public function description(): string { return 'Get an ActiveCampaign campaign by ID.'; }
    public function parameters(): array { return ['campaign_id' => ['type' => 'integer', 'required' => true]]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getCampaign($this->requiredInt($args, 'campaign_id', 'campaign_id'))); }
}
