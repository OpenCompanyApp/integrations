<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Get a Ghost offer. */
class GhostGetOffer extends AbstractGhostTool { public function name(): string { return 'ghost_get_offer'; } public function description(): string { return 'Get a Ghost offer by ID.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Offer ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getOffer($this->requiredString($args, 'id'), $this->objectArg($args, 'params'))); } }
