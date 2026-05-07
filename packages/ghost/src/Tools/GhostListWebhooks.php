<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** List Ghost webhooks. */
class GhostListWebhooks extends AbstractGhostTool { public function name(): string { return 'ghost_list_webhooks'; } public function description(): string { return 'List Ghost webhooks.'; } public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listWebhooks($this->objectArg($args, 'params'))); } }
