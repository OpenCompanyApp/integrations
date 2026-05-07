<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Delete a Ghost post. */
class GhostDeletePost extends AbstractGhostTool { public function name(): string { return 'ghost_delete_post'; } public function description(): string { return 'Delete a Ghost post by ID.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Post ID.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deletePost($this->requiredString($args, 'id'))); } }
