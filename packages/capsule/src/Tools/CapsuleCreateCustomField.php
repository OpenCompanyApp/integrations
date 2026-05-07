<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Create a Capsule CRM custom field definition. */
class CapsuleCreateCustomField extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_create_custom_field'; }
    public function description(): string { return 'Create a custom field definition for parties, opportunities, or cases.'; }
    public function parameters(): array { return ['entity' => ['type' => 'string', 'required' => true, 'description' => 'parties, opportunities, or kases.'], 'definition' => ['type' => 'object', 'required' => true, 'description' => 'Custom field definition payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createCustomField($this->requiredString($args, 'entity'), $this->objectArg($args, 'definition'))); }
}
