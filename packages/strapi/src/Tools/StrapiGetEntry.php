<?php

namespace OpenCompany\Integrations\Strapi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Strapi\StrapiService;

class StrapiGetEntry implements Tool
{
    /**
     * Create a new StrapiGetEntry tool instance.
     */
    public function __construct(
        private StrapiService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'strapi_get_entry';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get a single entry from Strapi by content type and ID. Supports population of relations and media.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'content_type' => ['type' => 'string', 'required' => true, 'description' => 'The API ID of the content type (e.g., "article", "page", "product").'],
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The entry ID.'],
            'populate' => ['type' => 'string', 'description' => 'Relations to populate. Use "*" for all, or a specific field name (e.g., "author", "image").'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Strapi integration is not configured.');
            }

            $contentType = $args['content_type'];
            $id = $args['id'];
            $params = [];

            if (isset($args['populate'])) {
                $params['populate'] = $args['populate'];
            }

            $result = $this->service->getEntry($contentType, $id, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
