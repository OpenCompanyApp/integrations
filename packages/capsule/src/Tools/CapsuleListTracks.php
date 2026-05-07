<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** List Capsule CRM track definitions. */
class CapsuleListTracks extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_list_tracks'; }
    public function description(): string { return 'List Capsule CRM track definitions for opportunities and cases.'; }
    public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listTracks($this->objectArg($args, 'params'))); }
}
