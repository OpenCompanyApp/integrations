<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/** Call a safe relative Capsule CRM API path with POST. */
class CapsuleApiPost extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_api_post'; }
    public function description(): string { return 'Call a safe relative Capsule CRM API path with POST for endpoints not covered by a dedicated tool.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path below /api/v2.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiPost($this->requiredString($args, 'path'), $this->objectArg($args, 'payload'), $this->objectArg($args, 'query'))); }
}
