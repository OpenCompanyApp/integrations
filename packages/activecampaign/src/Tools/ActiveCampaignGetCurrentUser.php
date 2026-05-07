<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated ActiveCampaign user.
 */
class ActiveCampaignGetCurrentUser extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_get_current_user'; }
    public function description(): string { return 'Get the authenticated ActiveCampaign user.'; }
    public function parameters(): array { return []; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getCurrentUser()); }
}
