<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generic ActiveCampaign GET request.
 */
class ActiveCampaignApiGet extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_api_get'; }
    public function description(): string { return 'Call a documented ActiveCampaign GET endpoint under /api/3.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiGet($this->requiredString($args, 'path', 'Path'), $this->arrayArg($args, 'params'))); }
}
