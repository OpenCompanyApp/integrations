<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Capsule CRM party.
 */
class CapsuleUpdateContact extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_update_contact'; }
    public function description(): string { return 'Update a Capsule CRM contact or organisation using a native party payload.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Party ID.'], 'party' => ['type' => 'object', 'required' => true, 'description' => 'Party update payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateParty($this->requiredInt($args, 'id'), $this->objectArg($args, 'party'))); }
}
