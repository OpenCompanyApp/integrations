<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new glossary in the Google Cloud Translation API.
 *
 * Glossaries allow you to specify custom translations for specific terms.
 * Entries are provided as an array of source/target term pairs.
 */
class GoogleTranslateCreateGlossary implements Tool
{
    public function __construct(
        private GoogleTranslateService $service,
    ) {}

    public function name(): string
    {
        return 'google_translate_create_glossary';
    }

    public function description(): string
    {
        return 'Create a new Google Cloud Translation glossary. Glossaries define custom translations for specific terms. Provide term pairs as an array of source/target strings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The glossary resource name (e.g., "projects/PROJECT_ID/locations/LOCATION/glossaries/my-glossary").'],
            'source_lang' => ['type' => 'string', 'required' => true, 'description' => 'The source language code (e.g., "en", "de").'],
            'target_lang' => ['type' => 'string', 'required' => true, 'description' => 'The target language code (e.g., "de", "fr").'],
            'entries' => ['type' => 'array', 'required' => true, 'description' => 'Array of term pairs, each with "source" and "target" keys. E.g., [{"source": "hello", "target": "hallo"}].'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Translate integration is not configured.');
            }

            $name = $args['name'];
            $sourceLang = $args['source_lang'];
            $targetLang = $args['target_lang'];
            $entries = $args['entries'];

            if (empty($entries)) {
                return ToolResult::error('Glossary entries cannot be empty.');
            }

            $result = $this->service->createGlossary($name, $sourceLang, $targetLang, $entries);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
