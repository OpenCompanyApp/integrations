<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Create a Capsule CRM task. */
class CapsuleCreateTask extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_create_task'; }
    public function description(): string { return 'Create a Capsule CRM task.'; }
    public function parameters(): array { return ['task' => ['type' => 'object', 'required' => true, 'description' => 'Task payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createTask($this->objectArg($args, 'task'))); }
}
