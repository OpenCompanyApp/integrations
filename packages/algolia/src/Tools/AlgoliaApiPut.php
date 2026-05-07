<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative Algolia API path with PUT.
 */
class AlgoliaApiPut extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_api_put'; }
    public function description(): string { return 'Call a safe relative Algolia API path with PUT for endpoints not covered by a dedicated tool.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path below /1.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiPut($this->requiredString($args, 'path'), $this->objectArg($args, 'payload'), $this->objectArg($args, 'query'))); }
}
