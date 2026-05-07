<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List opportunities associated with a party.
 */
class CapsuleListPartyOpportunities extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_list_party_opportunities'; }
    public function description(): string { return 'List opportunities associated with a Capsule CRM party.'; }
    public function parameters(): array { return ['party_id' => ['type' => 'integer', 'required' => true, 'description' => 'Party ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters such as page, perPage, and embed.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listPartyOpportunities($this->requiredInt($args, 'party_id'), $this->objectArg($args, 'params'))); }
}
