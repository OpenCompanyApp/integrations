<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all glossaries from the Google Cloud Translation API.
 *
 * Returns a list of glossaries with their names, language pairs, and entry counts.
 */
class GoogleTranslateListGlossaries implements Tool
{
    public function __construct(
        private GoogleTranslateService $service,
    ) {}

    public function name(): string
    {
        return 'google_translate_list_glossaries';
    }

    public function description(): string
    {
        return 'List all glossaries in your Google Cloud Translation project. Returns glossary names, language pairs, and entry counts.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Translate integration is not configured.');
            }

            $result = $this->service->listGlossaries();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
