<?php

namespace OpenCompany\Integrations\Strapi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Strapi\StrapiService;

class StrapiUpdateEntry implements Tool
{
    /**
     * Create a new StrapiUpdateEntry tool instance.
     */
    public function __construct(
        private StrapiService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'strapi_update_entry';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Update an existing entry in Strapi by content type and ID. The data is automatically wrapped in the required "data" envelope.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'content_type' => ['type' => 'string', 'required' => true, 'description' => 'The API ID of the content type (e.g., "article", "page", "product").'],
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The entry ID to update.'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'The fields to update as a JSON object (e.g., {"title": "Updated Title"}).'],
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
            $data = $args['data'];

            if (empty($data) || ! is_array($data)) {
                return ToolResult::error('The "data" parameter must be a non-empty object.');
            }

            $result = $this->service->updateEntry($contentType, $id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
