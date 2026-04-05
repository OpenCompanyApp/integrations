<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Webflow collection (CMS database) by its ID, including its field schema.
 */
class WebflowGetCollection implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_get_collection';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single Webflow collection (CMS database) by its ID.
        Returns the collection name, slug, and full field schema.
        MD;
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow collection.'],
        ];
    }

    /**
     * Get a collection by its ID, including the full field schema.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            $collectionId = $args['collection_id'] ?? '';

            if (empty($collectionId)) {
                return ToolResult::error('collection_id is required.');
            }

            $result = $this->service->getCollection($collectionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
