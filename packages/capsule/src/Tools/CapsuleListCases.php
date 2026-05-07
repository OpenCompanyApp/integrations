<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** List Capsule CRM projects/cases. */
class CapsuleListCases extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_list_cases'; }
    public function description(): string { return 'List Capsule CRM projects/cases.'; }
    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters such as page, perPage, q, since, status, and embed.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listCases($this->objectArg($args, 'params'))); }
}
