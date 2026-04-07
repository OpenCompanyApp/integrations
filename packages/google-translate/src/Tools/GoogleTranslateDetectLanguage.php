<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Detect the language of text using the Google Cloud Translation API.
 *
 * Returns detected language codes and confidence scores.
 */
class GoogleTranslateDetectLanguage implements Tool
{
    public function __construct(
        private GoogleTranslateService $service,
    ) {}

    public function name(): string
    {
        return 'google_translate_detect_language';
    }

    public function description(): string
    {
        return 'Detect the language of text using Google Cloud Translation. Returns detected language codes and confidence scores.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text to detect the language of.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Translate integration is not configured.');
            }

            $text = $args['text'];
            $result = $this->service->detectLanguage($text);

            $detections = $result['data']['detections'] ?? [];

            $formatted = array_map(function (array $detectionGroup): array {
                return array_map(function (array $d): array {
                    return [
                        'language' => $d['language'] ?? '',
                        'confidence' => $d['confidence'] ?? null,
                        'isReliable' => $d['isReliable'] ?? false,
                    ];
                }, $detectionGroup);
            }, $detections);

            return ToolResult::success([
                'detections' => $formatted,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
