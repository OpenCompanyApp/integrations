<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a CRM account.
 */
class ActiveCampaignUpdateAccount extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_update_account'; }
    public function description(): string { return 'Update an ActiveCampaign CRM account.'; }
    public function parameters(): array { return ['account_id' => ['type' => 'integer', 'required' => true], 'account' => ['type' => 'object', 'required' => true, 'description' => 'Account payload.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateAccount($this->requiredInt($args, 'account_id', 'account_id'), $this->arrayArg($args, 'account'))); }
}
