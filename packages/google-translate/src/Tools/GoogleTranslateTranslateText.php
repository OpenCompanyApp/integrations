<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Translate text using the Google Cloud Translation API.
 *
 * Supports translating one or more texts to a target language.
 * The source language can be auto-detected or specified explicitly.
 */
class GoogleTranslateTranslateText implements Tool
{
    public function __construct(
        private GoogleTranslateService $service,
    ) {}

    public function name(): string
    {
        return 'google_translate_translate_text';
    }

    public function description(): string
    {
        return 'Translate text using Google Cloud Translation. Supports automatic source language detection or explicit source language specification. Returns translated text with detected source language.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text to translate.'],
            'target' => ['type' => 'string', 'required' => true, 'description' => 'The target language code (e.g., "en", "de", "fr", "es", "ja", "zh").'],
            'source' => ['type' => 'string', 'description' => 'The source language code (e.g., "en", "de"). If omitted, Google auto-detects the source language.'],
            'format' => ['type' => 'string', 'description' => 'Text format: "text" (plain text, default) or "html" (HTML markup).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Translate integration is not configured.');
            }

            $text = $args['text'];
            $target = $args['target'];
            $source = $args['source'] ?? null;
            $format = $args['format'] ?? null;

            $result = $this->service->translateText($text, $target, $source, $format);

            $translations = $result['data']['translations'] ?? [];

            $formatted = array_map(function (array $t): array {
                return [
                    'translatedText' => $t['translatedText'] ?? '',
                    'detectedSourceLanguage' => $t['detectedSourceLanguage'] ?? null,
                ];
            }, $translations);

            $response = [
                'translations' => $formatted,
                'target' => $target,
            ];

            if ($source !== null) {
                $response['source'] = $source;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
