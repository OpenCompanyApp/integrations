<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Update a Capsule CRM tag definition. */
class CapsuleUpdateTag extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_update_tag'; }
    public function description(): string { return 'Update a tag definition for parties, opportunities, or cases.'; }
    public function parameters(): array { return ['entity' => ['type' => 'string', 'required' => true, 'description' => 'parties, opportunities, or kases.'], 'tag_id' => ['type' => 'integer', 'required' => true, 'description' => 'Tag ID.'], 'tag' => ['type' => 'object', 'required' => true, 'description' => 'Tag update payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateTag($this->requiredString($args, 'entity'), $this->requiredInt($args, 'tag_id'), $this->objectArg($args, 'tag'))); }
}
