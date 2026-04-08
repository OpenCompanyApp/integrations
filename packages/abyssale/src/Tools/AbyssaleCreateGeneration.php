<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\Integrations\Abyssale\AbyssaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AbyssaleCreateGeneration implements Tool
{
    public function __construct(
        private AbyssaleService $service,
    ) {}

    public function name(): string
    {
        return 'abyssale_create_generation';
    }

    public function description(): string
    {
        return 'Generate images from an Abyssale template. Specify the template, one or more output format IDs, and element modifications (text, images, colors) to customize the output.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The template UUID to generate from.'],
            'format_ids' => ['type' => 'array', 'required' => true, 'description' => 'Array of format UUIDs to generate (e.g., ["fmt_abc123", "fmt_def456"]). Use abyssale_list_formats to discover available formats.'],
            'modifications' => ['type' => 'object', 'description' => 'Element modifications as a JSON object. Keys are element names, values define overrides (e.g., {"title": {"payload": "New Headline"}, "background": {"payload": "https://example.com/bg.jpg"}}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Abyssale integration is not configured.');
            }

            if (empty($args['template_id'])) {
                return ToolResult::error('The template_id is required.');
            }

            if (empty($args['format_ids']) || !is_array($args['format_ids'])) {
                return ToolResult::error('The format_ids must be a non-empty array of format UUIDs.');
            }

            $modifications = [];
            if (isset($args['modifications'])) {
                $modifications = is_string($args['modifications'])
                    ? json_decode($args['modifications'], true) ?? []
                    : $args['modifications'];
            }

            $result = $this->service->createGeneration(
                $args['template_id'],
                $args['format_ids'],
                $modifications,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
