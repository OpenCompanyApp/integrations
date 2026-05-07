<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deal stages.
 */
class ActiveCampaignListDealStages extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_list_deal_stages'; }
    public function description(): string { return 'List ActiveCampaign deal stages.'; }
    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listDealStages($this->arrayArg($args, 'params'))); }
}
