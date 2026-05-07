<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** List Ghost offers. */
class GhostListOffers extends AbstractGhostTool { public function name(): string { return 'ghost_list_offers'; } public function description(): string { return 'List Ghost offers.'; } public function parameters(): array { return ['params' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listOffers($this->objectArg($args, 'params'))); } }
