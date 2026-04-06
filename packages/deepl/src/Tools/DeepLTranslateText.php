<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Translate text using the DeepL API.
 *
 * Supports translating one or more texts to a target language.
 * The source language can be auto-detected or specified explicitly.
 */
class DeepLTranslateText implements Tool
{
    public function __construct(
        private DeepLService $service,
    ) {}

    public function name(): string
    {
        return 'deepl_translate_text';
    }

    public function description(): string
    {
        return 'Translate text using DeepL. Supports automatic source language detection or explicit source language specification. Returns translated text with detected source language.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text to translate. For multiple texts, pass an array.'],
            'target_lang' => ['type' => 'string', 'required' => true, 'description' => 'The target language code (e.g., "EN", "DE", "FR", "ES", "JA", "ZH"). Use "EN-US" for American English, "EN-GB" for British English, "PT-BR" for Brazilian Portuguese.'],
            'source_lang' => ['type' => 'string', 'description' => 'The source language code (e.g., "EN", "DE"). If omitted, DeepL auto-detects the source language.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $text = $args['text'];
            $targetLang = $args['target_lang'];
            $sourceLang = $args['source_lang'] ?? null;

            $result = $this->service->translateText($text, $targetLang, $sourceLang);

            $translations = $result['translations'] ?? [];

            $formatted = array_map(function (array $t): array {
                return [
                    'text' => $t['text'] ?? '',
                    'detected_source_lang' => $t['detected_source_language'] ?? null,
                ];
            }, $translations);

            $response = [
                'translations' => $formatted,
                'target_lang' => $targetLang,
            ];

            if ($sourceLang !== null) {
                $response['source_lang'] = $sourceLang;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
