<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Create a Ghost tier. */
class GhostCreateTier extends AbstractGhostTool { public function name(): string { return 'ghost_create_tier'; } public function description(): string { return 'Create a Ghost membership tier.'; } public function parameters(): array { return ['tier' => ['type' => 'object', 'required' => true, 'description' => 'Tier payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createTier($this->objectArg($args, 'tier'))); } }
