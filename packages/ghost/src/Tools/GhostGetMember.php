<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Get a Ghost member. */
class GhostGetMember extends AbstractGhostTool { public function name(): string { return 'ghost_get_member'; } public function description(): string { return 'Get a Ghost member by ID.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Member ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getMember($this->requiredString($args, 'id'), $this->objectArg($args, 'params'))); } }
