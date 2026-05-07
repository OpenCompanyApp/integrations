<?php
namespace OpenCompany\Integrations\LemonSqueezy\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Generate a Lemon Squeezy order invoice. */
class LemonSqueezyGenerateOrderInvoice extends AbstractLemonSqueezyTool { public function name(): string { return 'lemonsqueezy_generate_order_invoice'; } public function description(): string { return 'Generate an invoice for a Lemon Squeezy order.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Order ID.'], 'payload' => ['type' => 'object', 'description' => 'Invoice request body.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->generateOrderInvoice($this->requiredString($args, 'id'), $this->objectArg($args, 'payload'))); } }
