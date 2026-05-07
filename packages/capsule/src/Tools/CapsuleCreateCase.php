<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Create a Capsule CRM project/case. */
class CapsuleCreateCase extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_create_case'; }
    public function description(): string { return 'Create a Capsule CRM project/case.'; }
    public function parameters(): array { return ['kase' => ['type' => 'object', 'required' => true, 'description' => 'Case payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createCase($this->objectArg($args, 'kase'))); }
}
