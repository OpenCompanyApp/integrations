<?php

namespace OpenCompany\Integrations\Transifex\Tools;

use OpenCompany\Integrations\Transifex\TransifexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List translations for a specific Transifex resource.
 */
class TransifexListTranslations implements Tool
{
    public function __construct(
        private TransifexService $service,
    ) {}

    public function name(): string
    {
        return 'transifex_list_translations';
    }

    public function description(): string
    {
        return 'List translations for a specific resource in a Transifex project. Optionally filter by language code.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project slug or ID (e.g., "my-project-slug").'],
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'The resource slug or ID (e.g., "my-resource-slug").'],
            'lang_code' => ['type' => 'string', 'description' => 'Optional language code to filter translations (e.g., "fr", "de", "ja").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Transifex integration is not configured.');
            }

            $projectId = $args['project_id'] ?? '';
            $resourceId = $args['resource_id'] ?? '';
            $langCode = $args['lang_code'] ?? null;

            if (empty($projectId)) {
                return ToolResult::error('Project ID is required.');
            }
            if (empty($resourceId)) {
                return ToolResult::error('Resource ID is required.');
            }

            $result = $this->service->listTranslations($projectId, $resourceId, $langCode);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
