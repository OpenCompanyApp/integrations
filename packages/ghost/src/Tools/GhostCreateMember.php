<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Create a Ghost member. */
class GhostCreateMember extends AbstractGhostTool { public function name(): string { return 'ghost_create_member'; } public function description(): string { return 'Create a Ghost member.'; } public function parameters(): array { return ['member' => ['type' => 'object', 'required' => true, 'description' => 'Member payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createMember($this->objectArg($args, 'member'))); } }
