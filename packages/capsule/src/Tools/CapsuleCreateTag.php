<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Create a Capsule CRM tag definition. */
class CapsuleCreateTag extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_create_tag'; }
    public function description(): string { return 'Create a tag definition for parties, opportunities, or cases.'; }
    public function parameters(): array { return ['entity' => ['type' => 'string', 'required' => true, 'description' => 'parties, opportunities, or kases.'], 'tag' => ['type' => 'object', 'required' => true, 'description' => 'Tag payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createTag($this->requiredString($args, 'entity'), $this->objectArg($args, 'tag'))); }
}
