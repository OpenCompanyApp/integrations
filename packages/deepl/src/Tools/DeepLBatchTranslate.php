<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * DeepL batch translate tool.
 *
 * Translates multiple text strings in a single API request to the
 * same target language. More efficient than calling translate individually.
 */
class DeepLBatchTranslate implements Tool
{
    /**
     * Create a new DeepLBatchTranslate tool instance.
     */
    public function __construct(
        private DeepLService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'deepl_batch_translate';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Translate multiple texts at once using DeepL. Send an array of text strings to translate to a single target language. More efficient than translating individually.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'texts' => ['type' => 'array', 'required' => true, 'description' => 'Array of text strings to translate.'],
            'target_lang' => ['type' => 'string', 'required' => true, 'description' => 'Target language code (e.g., "DE", "EN-US", "FR", "JA").'],
            'source_lang' => ['type' => 'string', 'description' => 'Source language code. Omit to auto-detect.'],
            'formality' => ['type' => 'string', 'description' => 'Desired formality: "default", "more" (formal), or "less" (informal).'],
        ];
    }

    /**
     * Execute the batch translation.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $texts = $args['texts'];

            if (!is_array($texts) || empty($texts)) {
                return ToolResult::error('texts must be a non-empty array of strings.');
            }

            $result = $this->service->batchTranslate(
                texts: $texts,
                targetLang: $args['target_lang'],
                sourceLang: $args['source_lang'] ?? null,
                formality: $args['formality'] ?? null,
            );

            $translations = $result['translations'] ?? [];

            $items = array_map(function (array $t, int $i) use ($texts) {
                return [
                    'original' => $texts[$i] ?? '',
                    'translated' => $t['text'] ?? '',
                    'detected_source_lang' => $t['detected_source_language'] ?? null,
                ];
            }, $translations, array_keys($translations));

            return ToolResult::success([
                'translations' => $items,
                'count' => count($items),
                'target_lang' => $args['target_lang'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
