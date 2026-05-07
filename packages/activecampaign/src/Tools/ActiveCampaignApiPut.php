<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generic ActiveCampaign PUT request.
 */
class ActiveCampaignApiPut extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_api_put'; }
    public function description(): string { return 'Call a documented ActiveCampaign PUT endpoint under /api/3.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true], 'payload' => ['type' => 'object', 'description' => 'JSON request body.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiPut($this->requiredString($args, 'path', 'Path'), $this->arrayArg($args, 'payload'))); }
}
