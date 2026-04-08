<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new glossary in the DeepL API.
 *
 * Glossaries allow you to specify custom translations for specific terms.
 * Entries are provided as tab-separated values (source\\ttarget), one pair per line.
 */
class DeepLCreateGlossary implements Tool
{
    public function __construct(
        private DeepLService $service,
    ) {}

    public function name(): string
    {
        return 'deepl_create_glossary';
    }

    public function description(): string
    {
        return 'Create a new DeepL glossary. Glossaries define custom translations for specific terms. Entries are tab-separated pairs (source\\ttarget), one per line.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'A name for the glossary (e.g., "Marketing Terms EN-DE").'],
            'source_lang' => ['type' => 'string', 'required' => true, 'description' => 'The source language code (e.g., "EN", "DE"). Must match the glossary entries.'],
            'target_lang' => ['type' => 'string', 'required' => true, 'description' => 'The target language code (e.g., "DE", "FR"). Must match the glossary entries.'],
            'entries' => ['type' => 'string', 'required' => true, 'description' => 'Glossary entries as tab-separated values. Each line: source_term<tab>target_term. Multiple lines for multiple entries.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $name = $args['name'];
            $sourceLang = $args['source_lang'];
            $targetLang = $args['target_lang'];
            $entries = $args['entries'];

            if (empty(trim($entries))) {
                return ToolResult::error('Glossary entries cannot be empty.');
            }

            $result = $this->service->createGlossary($name, $sourceLang, $targetLang, $entries);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
