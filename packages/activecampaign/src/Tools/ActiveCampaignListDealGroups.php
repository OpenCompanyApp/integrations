<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deal pipelines.
 */
class ActiveCampaignListDealGroups extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_list_deal_groups'; }
    public function description(): string { return 'List ActiveCampaign deal pipelines.'; }
    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listDealGroups($this->arrayArg($args, 'params'))); }
}
