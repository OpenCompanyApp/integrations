<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all glossaries from the DeepL API.
 *
 * Returns a list of glossaries with their IDs, names, source/target languages,
 * and entry counts.
 */
class DeepLListGlossaries implements Tool
{
    public function __construct(
        private DeepLService $service,
    ) {}

    public function name(): string
    {
        return 'deepl_list_glossaries';
    }

    public function description(): string
    {
        return 'List all glossaries in your DeepL account. Returns glossary IDs, names, language pairs, and entry counts.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $result = $this->service->listGlossaries();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
