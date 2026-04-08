<?php

namespace OpenCompany\Integrations\Crowdin\Tools;

use OpenCompany\Integrations\Crowdin\CrowdinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List translations for a Crowdin project.
 *
 * Returns a paginated list of translations with their text, language, and status.
 */
class CrowdinListTranslations implements Tool
{
    public function __construct(
        private CrowdinService $service,
    ) {}

    public function name(): string
    {
        return 'crowdin_list_translations';
    }

    public function description(): string
    {
        return 'List translations in a Crowdin project. Returns translated text, language info, and approval status. Supports filtering by string or language.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
            'string_id' => ['type' => 'integer', 'description' => 'Filter translations by source string ID.'],
            'language_id' => ['type' => 'integer', 'description' => 'Filter translations by language ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of translations to return (default 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset (default 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crowdin integration is not configured.');
            }

            $projectId = $args['project_id'];
            $stringId = $args['string_id'] ?? null;
            $languageId = $args['language_id'] ?? null;
            $limit = $args['limit'] ?? 25;
            $offset = $args['offset'] ?? 0;

            $result = $this->service->listTranslations($projectId, $stringId, $languageId, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
