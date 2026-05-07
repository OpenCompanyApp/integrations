<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Update a Ghost tier. */
class GhostUpdateTier extends AbstractGhostTool { public function name(): string { return 'ghost_update_tier'; } public function description(): string { return 'Update a Ghost membership tier.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Tier ID.'], 'tier' => ['type' => 'object', 'required' => true, 'description' => 'Tier update payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateTier($this->requiredString($args, 'id'), $this->objectArg($args, 'tier'))); } }
