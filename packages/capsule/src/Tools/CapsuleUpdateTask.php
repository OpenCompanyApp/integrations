<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Update a Capsule CRM task. */
class CapsuleUpdateTask extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_update_task'; }
    public function description(): string { return 'Update a Capsule CRM task.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID.'], 'task' => ['type' => 'object', 'required' => true, 'description' => 'Task update payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateTask($this->requiredInt($args, 'id'), $this->objectArg($args, 'task'))); }
}
