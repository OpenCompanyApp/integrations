<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a tag to a contact.
 */
class ActiveCampaignAddContactTag extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_add_contact_tag'; }
    public function description(): string { return 'Add an existing tag to an existing contact.'; }
    public function parameters(): array { return ['contact_id' => ['type' => 'integer', 'required' => true], 'tag_id' => ['type' => 'integer', 'required' => true]]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->addContactTag($this->requiredInt($args, 'contact_id', 'contact_id'), $this->requiredInt($args, 'tag_id', 'tag_id'))); }
}
