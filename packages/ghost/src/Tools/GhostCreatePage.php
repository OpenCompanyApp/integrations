<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Create a Ghost page. */
class GhostCreatePage extends AbstractGhostTool { public function name(): string { return 'ghost_create_page'; } public function description(): string { return 'Create a Ghost page.'; } public function parameters(): array { return ['page' => ['type' => 'object', 'required' => true, 'description' => 'Page payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createPage($this->objectArg($args, 'page'))); } }
