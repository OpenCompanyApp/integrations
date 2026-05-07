<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a contact using ActiveCampaign contact sync.
 */
class ActiveCampaignSyncContact extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_sync_contact'; }
    public function description(): string { return 'Create or update a contact by email using /contact/sync.'; }
    public function parameters(): array { return ['contact' => ['type' => 'object', 'required' => true, 'description' => 'ActiveCampaign contact payload.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->syncContact($this->arrayArg($args, 'contact'))); }
}
