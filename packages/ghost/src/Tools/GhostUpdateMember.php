<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Update a Ghost member. */
class GhostUpdateMember extends AbstractGhostTool { public function name(): string { return 'ghost_update_member'; } public function description(): string { return 'Update a Ghost member.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Member ID.'], 'member' => ['type' => 'object', 'required' => true, 'description' => 'Member update payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateMember($this->requiredString($args, 'id'), $this->objectArg($args, 'member'))); } }
