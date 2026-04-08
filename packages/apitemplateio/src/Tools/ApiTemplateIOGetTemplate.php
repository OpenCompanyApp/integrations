<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving details of a specific API Template IO template.
 *
 * Sends a GET request to the /templates/{id} endpoint to fetch the full
 * template definition including its schema, layout, and configuration.
 */
class ApiTemplateIOGetTemplate implements Tool
{
    /**
     * Create a new ApiTemplateIOGetTemplate tool instance.
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
        return 'apitemplateio_get_template';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific API Template IO template by ID. Returns the template definition, schema, and configuration.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The template ID to retrieve (e.g., "tpl_abc123").'],
        ];
    }

    /**
     * Execute the tool — get a template by ID.
     *
     * @param array<string, mixed> $args The tool arguments.
     *
     * @return ToolResult The result containing the template details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            $templateId = $args['template_id'] ?? '';
            if (empty($templateId)) {
                return ToolResult::error('The "template_id" parameter is required.');
            }

            $result = $this->service->getTemplate($templateId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
