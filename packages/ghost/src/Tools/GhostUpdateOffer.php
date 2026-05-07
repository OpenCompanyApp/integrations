<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Update a Ghost offer. */
class GhostUpdateOffer extends AbstractGhostTool { public function name(): string { return 'ghost_update_offer'; } public function description(): string { return 'Update a Ghost offer.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Offer ID.'], 'offer' => ['type' => 'object', 'required' => true, 'description' => 'Offer update payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateOffer($this->requiredString($args, 'id'), $this->objectArg($args, 'offer'))); } }
