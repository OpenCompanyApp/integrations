<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Get one Capsule CRM project/case. */
class CapsuleGetCase extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_get_case'; }
    public function description(): string { return 'Get one Capsule CRM project/case by ID.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Case ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters such as embed.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getCase($this->requiredInt($args, 'id'), $this->objectArg($args, 'params'))); }
}
