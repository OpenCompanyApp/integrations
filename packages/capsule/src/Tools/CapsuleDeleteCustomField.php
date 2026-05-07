<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Delete a Capsule CRM custom field definition. */
class CapsuleDeleteCustomField extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_delete_custom_field'; }
    public function description(): string { return 'Delete a custom field definition for parties, opportunities, or cases.'; }
    public function parameters(): array { return ['entity' => ['type' => 'string', 'required' => true, 'description' => 'parties, opportunities, or kases.'], 'definition_id' => ['type' => 'integer', 'required' => true, 'description' => 'Definition ID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteCustomField($this->requiredString($args, 'entity'), $this->requiredInt($args, 'definition_id'))); }
}
