<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ActiveCampaign tags.
 */
class ActiveCampaignListTags extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_list_tags'; }
    public function description(): string { return 'List ActiveCampaign tags.'; }
    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listTags($this->arrayArg($args, 'params'))); }
}
