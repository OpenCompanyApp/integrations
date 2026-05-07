<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Delete a Capsule CRM task. */
class CapsuleDeleteTask extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_delete_task'; }
    public function description(): string { return 'Delete a Capsule CRM task.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteTask($this->requiredInt($args, 'id'))); }
}
