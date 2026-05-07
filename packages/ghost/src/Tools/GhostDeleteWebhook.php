<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Delete a Ghost webhook. */
class GhostDeleteWebhook extends AbstractGhostTool { public function name(): string { return 'ghost_delete_webhook'; } public function description(): string { return 'Delete a Ghost webhook.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteWebhook($this->requiredString($args, 'id'))); } }
