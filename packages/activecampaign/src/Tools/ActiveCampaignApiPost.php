<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generic ActiveCampaign POST request.
 */
class ActiveCampaignApiPost extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_api_post'; }
    public function description(): string { return 'Call a documented ActiveCampaign POST endpoint under /api/3.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true], 'payload' => ['type' => 'object', 'description' => 'JSON request body.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiPost($this->requiredString($args, 'path', 'Path'), $this->arrayArg($args, 'payload'))); }
}
