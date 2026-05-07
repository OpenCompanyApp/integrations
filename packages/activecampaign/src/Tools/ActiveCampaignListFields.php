<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List custom contact fields.
 */
class ActiveCampaignListFields extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_list_fields'; }
    public function description(): string { return 'List custom contact fields.'; }
    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Query parameters such as limit or filters[perstag].']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listFields($this->arrayArg($args, 'params'))); }
}
