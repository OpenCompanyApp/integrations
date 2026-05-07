<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Call a safe relative Ghost Admin API path with DELETE. */
class GhostApiDelete extends AbstractGhostTool { public function name(): string { return 'ghost_api_delete'; } public function description(): string { return 'Call a safe relative Ghost Admin API path with DELETE.'; } public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiDelete($this->requiredString($args, 'path'), $this->objectArg($args, 'query'))); } }
