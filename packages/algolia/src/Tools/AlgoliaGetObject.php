<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single record from an Algolia index by its objectID.
 */
class AlgoliaGetObject implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_get_object';
    }

    public function description(): string
    {
        return 'Retrieve a single record from an Algolia index by its objectID. Returns all attributes of the object.';
    }

    public function parameters(): array
    {
        return [
            'indexName' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index.'],
            'objectID' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the record.'],
            'attributesToRetrieve' => ['type' => 'array', 'description' => 'List of attributes to include in the response. Default: all attributes.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Algolia integration is not configured.');
            }

            $indexName = $args['indexName'];
            $objectID = $args['objectID'];

            $result = $this->service->getObject($indexName, $objectID);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
