<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative Algolia API path with DELETE.
 */
class AlgoliaApiDelete extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_api_delete'; }
    public function description(): string { return 'Call a safe relative Algolia API path with DELETE for endpoints not covered by a dedicated tool.'; }
    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path below /1.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->apiDelete($this->requiredString($args, 'path'), $this->objectArg($args, 'query'))); }
}
