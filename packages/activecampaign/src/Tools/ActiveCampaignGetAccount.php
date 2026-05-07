<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a CRM account.
 */
class ActiveCampaignGetAccount extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_get_account'; }
    public function description(): string { return 'Get an ActiveCampaign CRM account by ID.'; }
    public function parameters(): array { return ['account_id' => ['type' => 'integer', 'required' => true]]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getAccount($this->requiredInt($args, 'account_id', 'account_id'))); }
}
