<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Get a Ghost newsletter. */
class GhostGetNewsletter extends AbstractGhostTool { public function name(): string { return 'ghost_get_newsletter'; } public function description(): string { return 'Get a Ghost newsletter by ID.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Newsletter ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getNewsletter($this->requiredString($args, 'id'), $this->objectArg($args, 'params'))); } }
