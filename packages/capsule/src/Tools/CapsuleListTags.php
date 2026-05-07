<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** List Capsule CRM tag definitions. */
class CapsuleListTags extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_list_tags'; }
    public function description(): string { return 'List tag definitions for parties, opportunities, or cases.'; }
    public function parameters(): array { return ['entity' => ['type' => 'string', 'required' => true, 'description' => 'parties, opportunities, or kases.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listTags($this->requiredString($args, 'entity'), $this->objectArg($args, 'params'))); }
}
