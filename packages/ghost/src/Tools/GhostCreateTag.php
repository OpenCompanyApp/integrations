<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Create a Ghost tag. */
class GhostCreateTag extends AbstractGhostTool { public function name(): string { return 'ghost_create_tag'; } public function description(): string { return 'Create a Ghost tag.'; } public function parameters(): array { return ['tag' => ['type' => 'object', 'required' => true, 'description' => 'Tag payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createTag($this->objectArg($args, 'tag'))); } }
