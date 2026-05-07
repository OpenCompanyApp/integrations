<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Create a Ghost offer. */
class GhostCreateOffer extends AbstractGhostTool { public function name(): string { return 'ghost_create_offer'; } public function description(): string { return 'Create a Ghost offer.'; } public function parameters(): array { return ['offer' => ['type' => 'object', 'required' => true, 'description' => 'Offer payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createOffer($this->objectArg($args, 'offer'))); } }
