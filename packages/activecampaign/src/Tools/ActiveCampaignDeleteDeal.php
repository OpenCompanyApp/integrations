<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a deal.
 */
class ActiveCampaignDeleteDeal extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_delete_deal'; }
    public function description(): string { return 'Delete an ActiveCampaign deal.'; }
    public function parameters(): array { return ['deal_id' => ['type' => 'integer', 'required' => true]]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteDeal($this->requiredInt($args, 'deal_id', 'deal_id'))); }
}
