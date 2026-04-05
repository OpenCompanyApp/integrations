<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing available API Template IO templates with pagination.
 *
 * Sends a GET request to the /templates endpoint, supporting limit/offset pagination
 * and optional filtering.
 */
class ApiTemplateIOListTemplates implements Tool
{
    /**
     * Create a new ApiTemplateIOListTemplates tool instance.
     *
     * @param ApiTemplateIOService $service The API Template IO service instance.
     */
    public function __construct(
        private ApiTemplateIOService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The tool name.
     */
    public function name(): string
    {
        return 'apitemplateio_list_templates';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List available templates in API Template IO. Returns a paginated list of template IDs, names, and metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description: string}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of templates to return per page (default: 50, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination — number of templates to skip (default: 0).'],
            'filter' => ['type' => 'string', 'description' => 'Optional filter expression to narrow down templates.'],
        ];
    }

    /**
     * Execute the tool — list templates.
     *
     * @param array<string, mixed> $args The tool arguments.
     *
     * @return ToolResult The result containing the paginated template list.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $filter = $args['filter'] ?? '';

            $result = $this->service->listTemplates($limit, $offset, $filter);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
