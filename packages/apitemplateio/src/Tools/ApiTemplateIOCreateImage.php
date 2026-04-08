<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for generating images (PNG or JPEG) from API Template IO templates.
 *
 * Sends a POST request to the /create endpoint with output_format set to "png" or "jpeg",
 * merging the provided data into the specified template.
 */
class ApiTemplateIOCreateImage implements Tool
{
    /**
     * Create a new ApiTemplateIOCreateImage tool instance.
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
        return 'apitemplateio_create_image';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Generate an image (PNG or JPEG) from an API Template IO template. Provide a template ID, data, and the desired output format.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string, enum?: string[]}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The template ID to use for image generation (e.g., "tpl_abc123").'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Key-value pairs to merge into the template placeholders.'],
            'output_format' => ['type' => 'string', 'description' => 'The image format to generate: "png" or "jpeg". Defaults to "png".', 'enum' => ['png', 'jpeg']],
            'output_html' => ['type' => 'boolean', 'description' => 'If true, returns the rendered HTML in addition to the image URL.'],
            'expire' => ['type' => 'integer', 'description' => 'Number of minutes after which the generated file URL expires (default: no expiry).'],
            'meta' => ['type' => 'string', 'description' => 'Optional metadata string to attach to the generation request.'],
        ];
    }

    /**
     * Execute the tool — generate an image from a template.
     *
     * @param array<string, mixed> $args The tool arguments.
     *
     * @return ToolResult The result containing the generated image URL and metadata.
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

            $outputFormat = $args['output_format'] ?? 'png';
            if (!in_array($outputFormat, ['png', 'jpeg'], true)) {
                return ToolResult::error('The "output_format" must be "png" or "jpeg".');
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

            $result = $this->service->createImage($templateId, $data, $outputFormat, $extraParams);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
