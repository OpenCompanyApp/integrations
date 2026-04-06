<?php

namespace OpenCompany\Integrations\Strapi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Strapi\StrapiService;

class StrapiDeleteEntry implements Tool
{
    /**
     * Create a new StrapiDeleteEntry tool instance.
     */
    public function __construct(
        private StrapiService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'strapi_delete_entry';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Delete an entry from Strapi by content type and ID. This action is permanent.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'content_type' => ['type' => 'string', 'required' => true, 'description' => 'The API ID of the content type (e.g., "article", "page", "product").'],
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The entry ID to delete.'],
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

            $result = $this->service->deleteEntry($contentType, $id);

            return ToolResult::success(array_merge($result, [
                'message' => "Entry {$id} of type '{$contentType}' has been deleted.",
            ]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
