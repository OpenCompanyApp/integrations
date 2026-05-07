<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Delete a Capsule CRM tag definition. */
class CapsuleDeleteTag extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_delete_tag'; }
    public function description(): string { return 'Delete a tag definition for parties, opportunities, or cases.'; }
    public function parameters(): array { return ['entity' => ['type' => 'string', 'required' => true, 'description' => 'parties, opportunities, or kases.'], 'tag_id' => ['type' => 'integer', 'required' => true, 'description' => 'Tag ID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteTag($this->requiredString($args, 'entity'), $this->requiredInt($args, 'tag_id'))); }
}
