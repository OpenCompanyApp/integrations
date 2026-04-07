<?php

namespace OpenCompany\Integrations\Runpod\Tools;

use OpenCompany\Integrations\Runpod\RunpodService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all available RunPod templates.
 *
 * Returns template objects with details like name, image, and machine settings.
 */
class RunpodListTemplates implements Tool
{
    public function __construct(
        private RunpodService $service,
    ) {}

    public function name(): string
    {
        return 'runpod_list_templates';
    }

    public function description(): string
    {
        return 'List all available RunPod templates. Returns template IDs, names, images, and machine configurations.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RunPod integration is not configured.');
            }

            $result = $this->service->listTemplates();

            $templates = $result['templates'] ?? $result;

            $formatted = array_map(function (array $template): array {
                return [
                    'template_id' => $template['id'] ?? null,
                    'name' => $template['name'] ?? null,
                    'image' => $template['imageName'] ?? null,
                    'is_public' => $template['isPublic'] ?? null,
                ];
            }, is_array($templates) ? $templates : []);

            return ToolResult::success([
                'templates' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
