<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

/**
 * Search companies with Clearbit Discovery.
 */
class ClearbitDiscoverySearch extends AbstractClearbitTool
{
    public function name(): string
    {
        return 'clearbit_discovery_search';
    }

    public function description(): string
    {
        return 'Search Clearbit Discovery companies using a query and optional pagination parameters.';
    }

    public function parameters(): array
    {
        return [
            'params' => ['type' => 'object', 'required' => true, 'description' => 'Query parameters such as query, page, and limit.'],
        ];
    }

    protected function callService(array $args): array
    {
        $params = $this->params($args);

        if (empty($params['query'])) {
            throw new \RuntimeException('params.query is required.');
        }

        return $this->service->searchDiscovery($params);
    }
}
