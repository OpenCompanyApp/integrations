<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List recent Algolia logs.
 */
class AlgoliaListLogs extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_list_logs'; }
    public function description(): string { return 'List recent Algolia logs for API activity and troubleshooting.'; }
    public function parameters(): array { return ['query' => ['type' => 'object', 'description' => 'Optional log query parameters such as offset, length, type, and indexName.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->listLogs($this->objectArg($args, 'query'))); }
}
