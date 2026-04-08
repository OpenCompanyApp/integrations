<?php

namespace OpenCompany\Integrations\Strapi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Strapi\StrapiService;

class StrapiCreateEntry implements Tool
{
    /**
     * Create a new StrapiCreateEntry tool instance.
     */
    public function __construct(
        private StrapiService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'strapi_create_entry';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new entry in Strapi for a given content type. The data is automatically wrapped in the required "data" envelope.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'content_type' => ['type' => 'string', 'required' => true, 'description' => 'The API ID of the content type (e.g., "article", "page", "product").'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'The entry data as a JSON object. Fields depend on the content type (e.g., {"title": "Hello", "body": "World"}).'],
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
            $data = $args['data'];

            if (empty($data) || ! is_array($data)) {
                return ToolResult::error('The "data" parameter must be a non-empty object.');
            }

            $result = $this->service->createEntry($contentType, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
