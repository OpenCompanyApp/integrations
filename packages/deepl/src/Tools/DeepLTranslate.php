<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * DeepL translate tool.
 *
 * Translates a single text string to a specified target language.
 * Optionally specifies source language and formality.
 */
class DeepLTranslate implements Tool
{
    /**
     * Create a new DeepLTranslate tool instance.
     */
    public function __construct(
        private DeepLService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'deepl_translate';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Translate a single text string using DeepL. Specify the target language and optionally the source language and formality preference. Returns the translated text along with detected source language.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text to translate.'],
            'target_lang' => ['type' => 'string', 'required' => true, 'description' => 'Target language code (e.g., "DE", "EN-US", "FR", "JA"). Use "EN-US" for American English, "EN-GB" for British English.'],
            'source_lang' => ['type' => 'string', 'description' => 'Source language code (e.g., "EN", "DE"). Omit to auto-detect the source language.'],
            'formality' => ['type' => 'string', 'description' => 'Desired formality: "default", "more" (formal), or "less" (informal). Only supported for certain target languages.'],
        ];
    }

    /**
     * Execute the translation.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $result = $this->service->translate(
                text: $args['text'],
                targetLang: $args['target_lang'],
                sourceLang: $args['source_lang'] ?? null,
                formality: $args['formality'] ?? null,
            );

            $translations = $result['translations'] ?? [];

            if (empty($translations)) {
                return ToolResult::error('No translation returned from DeepL.');
            }

            $translation = $translations[0];

            return ToolResult::success([
                'text' => $translation['text'] ?? '',
                'detected_source_lang' => $translation['detected_source_language'] ?? null,
                'target_lang' => $args['target_lang'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
