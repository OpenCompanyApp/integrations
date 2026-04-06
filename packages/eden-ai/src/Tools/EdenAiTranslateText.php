<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

use OpenCompany\Integrations\EdenAi\EdenAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Translate text between languages using AI models through Eden AI.
 *
 * Sends a translation request to one or more AI providers via the
 * Eden AI aggregation API. Supports automatic language detection
 * and translation between 50+ languages.
 */
class EdenAiTranslateText implements Tool
{
    public function __construct(
        private EdenAiService $service,
    ) {}

    public function name(): string
    {
        return 'edenai_translate_text';
    }

    public function description(): string
    {
        return 'Translate text between languages using AI models via Eden AI. Supports providers like Google Translate, DeepL, Amazon Translate, Microsoft Translator, and more. Detects the source language automatically if not specified.';
    }

    public function parameters(): array
    {
        return [
            'providers' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of translation providers (e.g., "google", "deepl", "amazon", "microsoft").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text to translate.'],
            'source_language' => ['type' => 'string', 'description' => 'Source language code (e.g., "en", "fr", "de"). Omit to auto-detect.'],
            'target_language' => ['type' => 'string', 'required' => true, 'description' => 'Target language code (e.g., "en", "fr", "de", "es", "ja", "zh").'],
            'fallback_providers' => ['type' => 'string', 'description' => 'Comma-separated list of fallback providers if the primary fails.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eden AI integration is not configured.');
            }

            $body = [
                'providers' => $args['providers'],
                'text' => $args['text'],
                'target_language' => $args['target_language'],
            ];

            if (isset($args['source_language'])) {
                $body['source_language'] = $args['source_language'];
            }

            if (isset($args['fallback_providers'])) {
                $body['fallback_providers'] = $args['fallback_providers'];
            }

            $result = $this->service->translateText($body);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the translation response.
     *
     * @param  array<string, mixed>  $result  Raw API response.
     * @return array<string, mixed> Formatted response with translation results.
     */
    private function formatResponse(array $result): array
    {
        $response = [];

        foreach ($result as $providerKey => $providerResult) {
            if (!is_array($providerResult)) {
                continue;
            }

            $entry = [
                'provider' => $providerKey,
            ];

            if (isset($providerResult['text'])) {
                $entry['translation'] = $providerResult['text'];
            }

            if (isset($providerResult['source_language'])) {
                $entry['detected_source'] = $providerResult['source_language'];
            }

            if (isset($providerResult['status'])) {
                $entry['status'] = $providerResult['status'];
            }

            if (isset($providerResult['cost'])) {
                $entry['cost'] = $providerResult['cost'];
            }

            if (isset($providerResult['error'])) {
                $entry['error'] = $providerResult['error'];
            }

            $response[] = $entry;
        }

        return [
            'results' => $response,
            'providerCount' => count($response),
        ];
    }
}
