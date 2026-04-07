<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific glossary from the Google Cloud Translation API.
 *
 * Returns glossary metadata including name, language pair, entry count, and submission time.
 */
class GoogleTranslateGetGlossary implements Tool
{
    public function __construct(
        private GoogleTranslateService $service,
    ) {}

    public function name(): string
    {
        return 'google_translate_get_glossary';
    }

    public function description(): string
    {
        return 'Get details of a specific Google Cloud Translation glossary by name. Returns glossary name, language pair, entry count, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The glossary resource name (e.g., "projects/PROJECT_ID/locations/LOCATION/glossaries/GLOSSARY_ID").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Translate integration is not configured.');
            }

            $name = $args['name'];
            $result = $this->service->getGlossary($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
