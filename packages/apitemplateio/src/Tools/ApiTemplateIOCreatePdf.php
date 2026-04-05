<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for generating PDF documents from API Template IO templates.
 *
 * Sends a POST request to the /create endpoint with output_format set to "pdf",
 * merging the provided data into the specified template.
 */
class ApiTemplateIOCreatePdf implements Tool
{
    /**
     * Create a new ApiTemplateIOCreatePdf tool instance.
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
        return 'apitemplateio_create_pdf';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Generate a PDF document from an API Template IO template. Provide a template ID and the data to merge into the template.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The template ID to use for PDF generation (e.g., "tpl_abc123").'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Key-value pairs to merge into the template placeholders.'],
            'output_html' => ['type' => 'boolean', 'description' => 'If true, returns the rendered HTML in addition to the PDF URL.'],
            'expire' => ['type' => 'integer', 'description' => 'Number of minutes after which the generated file URL expires (default: no expiry).'],
            'meta' => ['type' => 'string', 'description' => 'Optional metadata string to attach to the generation request.'],
        ];
    }

    /**
     * Execute the tool — generate a PDF from a template.
     *
     * @param array<string, mixed> $args The tool arguments.
     *
     * @return ToolResult The result containing the generated PDF URL and metadata.
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

            $data = $args['data'] ?? [];
            if (!is_array($data)) {
                return ToolResult::error('The "data" parameter must be an object (key-value pairs).');
            }

            $extraParams = [];
            if (isset($args['output_html'])) {
                $extraParams['output_html'] = (bool) $args['output_html'];
            }
            if (isset($args['expire'])) {
                $extraParams['expire'] = (int) $args['expire'];
            }
            if (isset($args['meta'])) {
                $extraParams['meta'] = $args['meta'];
            }

            $result = $this->service->createPdf($templateId, $data, $extraParams);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
