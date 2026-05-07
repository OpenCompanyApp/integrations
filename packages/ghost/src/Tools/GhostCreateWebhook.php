<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Create a Ghost webhook. */
class GhostCreateWebhook extends AbstractGhostTool { public function name(): string { return 'ghost_create_webhook'; } public function description(): string { return 'Create a Ghost webhook.'; } public function parameters(): array { return ['webhook' => ['type' => 'object', 'required' => true, 'description' => 'Webhook payload.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createWebhook($this->objectArg($args, 'webhook'))); } }
