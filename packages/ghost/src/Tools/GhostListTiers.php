<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** List Ghost tiers. */
class GhostListTiers extends AbstractGhostTool { public function name(): string { return 'ghost_list_tiers'; } public function description(): string { return 'List Ghost paid membership tiers.'; } public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listTiers($this->objectArg($args, 'params'))); } }
