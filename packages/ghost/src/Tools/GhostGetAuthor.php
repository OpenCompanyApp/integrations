<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Get a Ghost author/user. */
class GhostGetAuthor extends AbstractGhostTool { public function name(): string { return 'ghost_get_author'; } public function description(): string { return 'Get a Ghost author/user by ID.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Author/user ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getAuthor($this->requiredString($args, 'id'), $this->objectArg($args, 'params'))); } }
