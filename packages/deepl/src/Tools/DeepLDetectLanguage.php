<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * DeepL language detection tool.
 *
 * Detects the language of the given text using the DeepL API.
 * Returns the detected language code and confidence level.
 */
class DeepLDetectLanguage implements Tool
{
    /**
     * Create a new DeepLDetectLanguage tool instance.
     */
    public function __construct(
        private DeepLService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'deepl_detect_language';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Detect the language of a text using DeepL. Returns the detected language code (e.g., "EN", "DE", "FR") and confidence score.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text to identify the language of.'],
        ];
    }

    /**
     * Execute language detection.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $result = $this->service->detectLanguage($args['text']);

            return ToolResult::success([
                'language_code' => $result['language_code'] ?? null,
                'language_name' => $result['language_name'] ?? null,
                'confidence' => $result['confidence'] ?? null,
                'text_preview' => mb_substr($args['text'], 0, 100),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
