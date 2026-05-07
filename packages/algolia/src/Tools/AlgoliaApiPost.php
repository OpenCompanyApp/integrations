<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative Algolia API path with POST.
 */
class AlgoliaApiPost extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_api_post'; }
    public function description(): string { return 'Call a safe relative Algolia API path with POST for endpoints not covered by a dedicated tool.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path below /1.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'use_search_endpoint' => ['type' => 'boolean', 'description' => 'Use the DSN search endpoint.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiPost($this->requiredString($args, 'path'), $this->objectArg($args, 'payload'), $this->objectArg($args, 'query'), $this->boolArg($args, 'use_search_endpoint'))); }
}
