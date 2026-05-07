<?php
namespace OpenCompany\Integrations\LemonSqueezy\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Cancel a Lemon Squeezy subscription. */
class LemonSqueezyCancelSubscription extends AbstractLemonSqueezyTool { public function name(): string { return 'lemonsqueezy_cancel_subscription'; } public function description(): string { return 'Cancel a Lemon Squeezy subscription.'; } public function parameters(): array { return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Subscription ID.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->cancelSubscription($this->requiredString($args, 'id'))); } }
