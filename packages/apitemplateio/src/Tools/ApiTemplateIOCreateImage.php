<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate images from APITemplate.io visual templates.
 *
 * Sends image overrides to the v2 create-image endpoint and returns generated file metadata.
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
        return 'Generate PNG and/or JPEG images from an APITemplate.io image template. Provide a template ID and override payload.';
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
            'overrides' => ['type' => 'array', 'description' => 'Image object overrides. Each item should include a name and the properties to replace.'],
            'data' => ['type' => 'object', 'description' => 'Backward-compatible full image payload. Prefer overrides for new calls.'],
            'output_image_type' => ['type' => 'string', 'description' => 'Which image outputs to generate: all, jpegOnly, or pngOnly. Defaults to all.', 'enum' => ['all', 'jpegOnly', 'pngOnly']],
            'output_format' => ['type' => 'string', 'description' => 'Deprecated alias: png maps to pngOnly, jpeg maps to jpegOnly.', 'enum' => ['png', 'jpeg']],
            'expiration' => ['type' => 'integer', 'description' => 'Minutes until generated file URLs expire. Use 0 to store permanently.'],
            'expire' => ['type' => 'integer', 'description' => 'Deprecated alias for expiration.'],
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

            $payload = $args['data'] ?? [];
            if (isset($args['overrides'])) {
                if (! is_array($args['overrides'])) {
                    return ToolResult::error('The "overrides" parameter must be an array.');
                }
                $payload = ['overrides' => $args['overrides']];
            }

            if (! is_array($payload)) {
                return ToolResult::error('The image payload must be an object.');
            }

            $extraParams = $this->queryParams($args);

            $result = $this->service->createImage($templateId, $payload, $extraParams);

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
        if (isset($args['output_image_type'])) {
            $params['output_image_type'] = $args['output_image_type'];
        } elseif (($args['output_format'] ?? null) === 'png') {
            $params['output_image_type'] = 'pngOnly';
        } elseif (($args['output_format'] ?? null) === 'jpeg') {
            $params['output_image_type'] = 'jpegOnly';
        }

        if (isset($args['expiration'])) {
            $params['expiration'] = (int) $args['expiration'];
        } elseif (isset($args['expire'])) {
            $params['expiration'] = (int) $args['expire'];
        }
        if (isset($args['meta'])) {
            $params['meta'] = $args['meta'];
        }

        return $params;
    }
}
