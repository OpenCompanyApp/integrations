<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** List Capsule CRM projects/cases associated with a party. */
class CapsuleListPartyCases extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_list_party_cases'; }
    public function description(): string { return 'List projects/cases associated with a Capsule CRM party.'; }
    public function parameters(): array { return ['party_id' => ['type' => 'integer', 'required' => true, 'description' => 'Party ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listPartyCases($this->requiredInt($args, 'party_id'), $this->objectArg($args, 'params'))); }
}
