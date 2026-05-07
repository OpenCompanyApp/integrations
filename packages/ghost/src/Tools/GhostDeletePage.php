<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Delete a Ghost page. */
class GhostDeletePage extends AbstractGhostTool { public function name(): string { return 'ghost_delete_page'; } public function description(): string { return 'Delete a Ghost page by ID.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Page ID.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deletePage($this->requiredString($args, 'id'))); } }
