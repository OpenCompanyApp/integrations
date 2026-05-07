<?php
namespace OpenCompany\Integrations\LemonSqueezy\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Call a safe relative Lemon Squeezy API path with GET. */
class LemonSqueezyApiGet extends AbstractLemonSqueezyTool { public function name(): string { return 'lemonsqueezy_api_get'; } public function description(): string { return 'Call a safe relative Lemon Squeezy API path with GET.'; } public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiGet($this->requiredString($args, 'path'), $this->objectArg($args, 'query'))); } }
