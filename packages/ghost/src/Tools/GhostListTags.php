<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** List Ghost tags. */
class GhostListTags extends AbstractGhostTool { public function name(): string { return 'ghost_list_tags'; } public function description(): string { return 'List Ghost tags.'; } public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listTags($this->objectArg($args, 'params'))); } }
