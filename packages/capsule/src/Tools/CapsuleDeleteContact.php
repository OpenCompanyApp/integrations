<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Capsule CRM party.
 */
class CapsuleDeleteContact extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_delete_contact'; }
    public function description(): string { return 'Delete a Capsule CRM contact or organisation.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Party ID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteParty($this->requiredInt($args, 'id'))); }
}
