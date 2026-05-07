<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List tags applied to a contact.
 */
class ActiveCampaignListContactTags extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_list_contact_tags'; }
    public function description(): string { return 'List tags applied to a contact.'; }
    public function parameters(): array { return ['contact_id' => ['type' => 'integer', 'required' => true]]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listContactTags($this->requiredInt($args, 'contact_id', 'contact_id'))); }
}
