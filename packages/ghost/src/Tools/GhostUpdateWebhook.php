<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Update a Ghost webhook. */
class GhostUpdateWebhook extends AbstractGhostTool { public function name(): string { return 'ghost_update_webhook'; } public function description(): string { return 'Update a Ghost webhook.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'], 'webhook' => ['type' => 'object', 'required' => true, 'description' => 'Webhook update payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateWebhook($this->requiredString($args, 'id'), $this->objectArg($args, 'webhook'))); } }
