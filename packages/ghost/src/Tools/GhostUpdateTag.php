<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Update a Ghost tag. */
class GhostUpdateTag extends AbstractGhostTool { public function name(): string { return 'ghost_update_tag'; } public function description(): string { return 'Update a Ghost tag.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Tag ID.'], 'tag' => ['type' => 'object', 'required' => true, 'description' => 'Tag update payload including updated_at.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateTag($this->requiredString($args, 'id'), $this->objectArg($args, 'tag'))); } }
