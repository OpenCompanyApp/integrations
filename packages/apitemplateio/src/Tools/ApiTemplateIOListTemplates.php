<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List saved APITemplate.io templates.
 *
 * Supports documented v2 template filters such as format, template_id, group_name, and layer info.
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
            'limit' => ['type' => 'integer', 'description' => 'Number of templates to return. Defaults to 300 upstream.'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination. Defaults to 0 upstream.'],
            'format' => ['type' => 'string', 'description' => 'Filter by template format: PDF or JPEG.', 'enum' => ['PDF', 'JPEG']],
            'template_id' => ['type' => 'string', 'description' => 'Filter to a specific template ID.'],
            'group_name' => ['type' => 'string', 'description' => 'Filter templates by group name.'],
            'with_layer_info' => ['type' => 'boolean', 'description' => 'Include image-template layer information when true.'],
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

            $result = $this->service->listTemplates($this->queryParams($args));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>
     */
    private function queryParams(array $args): array
    {
        $params = [];
        foreach (['limit', 'offset', 'format', 'template_id', 'group_name'] as $key) {
            if (isset($args[$key])) {
                $params[$key] = $args[$key];
            }
        }
        if (isset($args['with_layer_info'])) {
            $params['with_layer_info'] = $args['with_layer_info'] ? '1' : '0';
        }

        return $params;
    }
}
