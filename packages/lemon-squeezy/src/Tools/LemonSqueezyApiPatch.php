<?php
namespace OpenCompany\Integrations\LemonSqueezy\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Call a safe relative Lemon Squeezy API path with PATCH. */
class LemonSqueezyApiPatch extends AbstractLemonSqueezyTool { public function name(): string { return 'lemonsqueezy_api_patch'; } public function description(): string { return 'Call a safe relative Lemon Squeezy API path with PATCH.'; } public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'], 'payload' => ['type' => 'object', 'description' => 'JSON body.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']]; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiPatch($this->requiredString($args, 'path'), $this->objectArg($args, 'payload'), $this->objectArg($args, 'query'))); } }
