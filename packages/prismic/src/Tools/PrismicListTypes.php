<?php

namespace OpenCompany\Integrations\Prismic\Tools;

use OpenCompany\Integrations\Prismic\PrismicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PrismicListTypes implements Tool
{
    /**
     * Create a new PrismicListTypes tool instance.
     */
    public function __construct(
        private PrismicService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'prismic_list_types';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all custom types defined in the Prismic repository. Returns type IDs and names that can be used for document queries.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of types to return (default: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Prismic integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listTypes($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
