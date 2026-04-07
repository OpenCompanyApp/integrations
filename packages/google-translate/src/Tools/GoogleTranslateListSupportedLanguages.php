<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List supported languages from the Google Cloud Translation API.
 *
 * Returns language codes and names. Names can be localized by specifying a target language.
 */
class GoogleTranslateListSupportedLanguages implements Tool
{
    public function __construct(
        private GoogleTranslateService $service,
    ) {}

    public function name(): string
    {
        return 'google_translate_list_supported_languages';
    }

    public function description(): string
    {
        return 'List languages supported by Google Cloud Translation. Returns language codes and names. Optionally specify a target language to localize language names.';
    }

    public function parameters(): array
    {
        return [
            'target' => ['type' => 'string', 'description' => 'Target language code for localizing language names (e.g., "en" for English names, "fr" for French names). If omitted, only language codes are returned.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Translate integration is not configured.');
            }

            $target = $args['target'] ?? null;
            $result = $this->service->listSupportedLanguages($target);

            $languages = $result['data']['languages'] ?? [];

            return ToolResult::success([
                'languages' => $languages,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
