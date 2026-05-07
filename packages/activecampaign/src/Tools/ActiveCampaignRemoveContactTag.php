<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Remove a contact tag relationship.
 */
class ActiveCampaignRemoveContactTag extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_remove_contact_tag'; }
    public function description(): string { return 'Remove a tag relationship from a contact by contactTag ID.'; }
    public function parameters(): array { return ['contact_tag_id' => ['type' => 'integer', 'required' => true]]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->removeContactTag($this->requiredInt($args, 'contact_tag_id', 'contact_tag_id'))); }
}
