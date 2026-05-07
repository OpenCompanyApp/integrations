<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Update a Capsule CRM project/case. */
class CapsuleUpdateCase extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_update_case'; }
    public function description(): string { return 'Update a Capsule CRM project/case.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Case ID.'], 'kase' => ['type' => 'object', 'required' => true, 'description' => 'Case update payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateCase($this->requiredInt($args, 'id'), $this->objectArg($args, 'kase'))); }
}
