<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Browse records in an Algolia index.
 */
class AlgoliaBrowse extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_browse'; }
    public function description(): string { return 'Browse records in an Algolia index for exports or complete scans.'; }
    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'],
            'params' => ['type' => 'object', 'description' => 'Browse parameters such as query, cursor, filters, or hitsPerPage.'],
        ];
    }

    /**
     * Browse an Algolia index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->browse($this->requiredString($args, 'indexName'), $this->objectArg($args, 'params')));
    }
}
