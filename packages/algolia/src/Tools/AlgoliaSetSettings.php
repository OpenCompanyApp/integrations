<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update Algolia index settings.
 */
class AlgoliaSetSettings extends AbstractAlgoliaTool
{
    public function name(): string { return 'algolia_set_settings'; }
    public function description(): string { return 'Update Algolia index settings such as searchableAttributes, ranking, facets, replicas, and typo tolerance.'; }
    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The index name.'],
            'settings' => ['type' => 'object', 'required' => true, 'description' => 'Settings payload.'],
            'query' => ['type' => 'object', 'description' => 'Optional query parameters such as forwardToReplicas.'],
        ];
    }

    /**
     * Update index settings.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->setSettings(
            $this->requiredString($args, 'indexName'),
            $this->objectArg($args, 'settings'),
            $this->objectArg($args, 'query')
        ));
    }
}
