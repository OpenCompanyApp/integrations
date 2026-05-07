<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Get one Capsule CRM task. */
class CapsuleGetTask extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_get_task'; }
    public function description(): string { return 'Get one Capsule CRM task by ID.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Task ID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getTask($this->requiredInt($args, 'id'))); }
}
