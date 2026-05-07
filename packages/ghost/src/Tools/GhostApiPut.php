<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Call a safe relative Ghost Admin API path with PUT. */
class GhostApiPut extends AbstractGhostTool { public function name(): string { return 'ghost_api_put'; } public function description(): string { return 'Call a safe relative Ghost Admin API path with PUT.'; } public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'], 'payload' => ['type' => 'object', 'description' => 'JSON body.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiPut($this->requiredString($args, 'path'), $this->objectArg($args, 'payload'), $this->objectArg($args, 'query'))); } }
