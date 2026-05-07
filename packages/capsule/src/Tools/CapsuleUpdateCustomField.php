<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Update a Capsule CRM custom field definition. */
class CapsuleUpdateCustomField extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_update_custom_field'; }
    public function description(): string { return 'Update a custom field definition for parties, opportunities, or cases.'; }
    public function parameters(): array { return ['entity' => ['type' => 'string', 'required' => true, 'description' => 'parties, opportunities, or kases.'], 'definition_id' => ['type' => 'integer', 'required' => true, 'description' => 'Definition ID.'], 'definition' => ['type' => 'object', 'required' => true, 'description' => 'Custom field definition update payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateCustomField($this->requiredString($args, 'entity'), $this->requiredInt($args, 'definition_id'), $this->objectArg($args, 'definition'))); }
}
