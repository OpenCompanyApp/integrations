<?php
namespace OpenCompany\Integrations\LemonSqueezy\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Refund a Lemon Squeezy order. */
class LemonSqueezyRefundOrder extends AbstractLemonSqueezyTool { public function name(): string { return 'lemonsqueezy_refund_order'; } public function description(): string { return 'Issue a refund for a Lemon Squeezy order.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Order ID.'], 'payload' => ['type' => 'object', 'description' => 'Refund request body.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->refundOrder($this->requiredString($args, 'id'), $this->objectArg($args, 'payload'))); } }
