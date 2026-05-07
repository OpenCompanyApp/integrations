<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Update a Ghost page. */
class GhostUpdatePage extends AbstractGhostTool { public function name(): string { return 'ghost_update_page'; } public function description(): string { return 'Update a Ghost page.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Page ID.'], 'page' => ['type' => 'object', 'required' => true, 'description' => 'Page update payload including updated_at.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updatePage($this->requiredString($args, 'id'), $this->objectArg($args, 'page'))); } }
