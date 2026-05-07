<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a CRM account.
 */
class ActiveCampaignCreateAccount extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_create_account'; }
    public function description(): string { return 'Create an ActiveCampaign CRM account.'; }
    public function parameters(): array { return ['account' => ['type' => 'object', 'required' => true, 'description' => 'Account payload.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createAccount($this->arrayArg($args, 'account'))); }
}
