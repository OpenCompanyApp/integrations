<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Copy or move Algolia indices through the index operation endpoint.
 */
class AlgoliaIndexOperation extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_index_operation'; }
    public function description(): string { return 'Run an Algolia index operation such as copy or move to another index.'; }
    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'Source index name.'],
            'operation' => ['type' => 'string', 'required' => true, 'description' => 'Operation name, such as copy or move.'],
            'destination' => ['type' => 'string', 'required' => true, 'description' => 'Destination index name.'],
            'extra' => ['type' => 'object', 'description' => 'Optional additional operation payload.'],
        ];
    }

    /**
     * Run an index operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->indexOperation(
            $this->requiredString($args, 'indexName'),
            $this->requiredString($args, 'operation'),
            $this->requiredString($args, 'destination'),
            $this->objectArg($args, 'extra')
        ));
    }
}
