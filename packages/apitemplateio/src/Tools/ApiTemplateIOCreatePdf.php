<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate PDF documents from APITemplate.io templates.
 *
 * Sends JSON data to the v2 create-pdf endpoint and returns the generated file metadata.
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
            'export_type' => ['type' => 'string', 'description' => 'Return mode: "json" for a CDN URL or "file" for binary output. Defaults to "json".', 'enum' => ['json', 'file']],
            'output_format' => ['type' => 'string', 'description' => 'Output format: pdf, html, png, or jpeg. Defaults to pdf.', 'enum' => ['pdf', 'html', 'png', 'jpeg']],
            'output_html' => ['type' => 'boolean', 'description' => 'If true, returns rendered HTML as an html_url field.'],
            'expiration' => ['type' => 'integer', 'description' => 'Minutes until the generated file URL expires. Use 0 to store permanently.'],
            'expire' => ['type' => 'integer', 'description' => 'Deprecated alias for expiration.'],
            'filename' => ['type' => 'string', 'description' => 'Optional generated filename, usually ending with .pdf.'],
            'async' => ['type' => 'boolean', 'description' => 'Generate asynchronously. Requires webhook_url when true.'],
            'webhook_url' => ['type' => 'string', 'description' => 'Webhook URL for asynchronous generation callbacks.'],
            'webhook_method' => ['type' => 'string', 'description' => 'Webhook method: GET or POST. Defaults to GET.', 'enum' => ['GET', 'POST']],
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

            $extraParams = $this->queryParams($args);

            $result = $this->service->createPdf($templateId, $data, $extraParams);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Extract supported query parameters from tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>
     */
    private function queryParams(array $args): array
    {
        $params = [];
        foreach (['export_type', 'output_format', 'filename', 'webhook_url', 'webhook_method', 'meta'] as $key) {
            if (isset($args[$key])) {
                $params[$key] = $args[$key];
            }
        }

        if (isset($args['output_html'])) {
            $params['output_html'] = $args['output_html'] ? '1' : '0';
        }
        if (isset($args['expiration'])) {
            $params['expiration'] = (int) $args['expiration'];
        } elseif (isset($args['expire'])) {
            $params['expiration'] = (int) $args['expire'];
        }
        if (isset($args['async'])) {
            $params['async'] = $args['async'] ? '1' : '0';
        }

        return $params;
    }
}
