<?php

namespace OpenCompany\Integrations\Crowdin\Tools;

use OpenCompany\Integrations\Crowdin\CrowdinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List supported languages from the Crowdin API.
 *
 * Returns a paginated list of languages with their IDs, codes, and names.
 */
class CrowdinListLanguages implements Tool
{
    public function __construct(
        private CrowdinService $service,
    ) {}

    public function name(): string
    {
        return 'crowdin_list_languages';
    }

    public function description(): string
    {
        return 'List languages supported by Crowdin. Returns language IDs, locale codes (e.g., "en", "de", "fr"), names, and text direction.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of languages to return (default 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset (default 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crowdin integration is not configured.');
            }

            $limit = $args['limit'] ?? 25;
            $offset = $args['offset'] ?? 0;

            $result = $this->service->listLanguages($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
