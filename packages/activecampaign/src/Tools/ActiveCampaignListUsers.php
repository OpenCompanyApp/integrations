<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ActiveCampaign account users.
 */
class ActiveCampaignListUsers extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_list_users'; }
    public function description(): string { return 'List users in the ActiveCampaign account.'; }
    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listUsers($this->arrayArg($args, 'params'))); }
}
