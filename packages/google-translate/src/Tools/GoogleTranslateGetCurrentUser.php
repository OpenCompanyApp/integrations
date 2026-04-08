<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Verify the Google Cloud Translation API key and get connection information.
 *
 * Makes a lightweight request to confirm the API key is valid and the service is accessible.
 */
class GoogleTranslateGetCurrentUser implements Tool
{
    public function __construct(
        private GoogleTranslateService $service,
    ) {}

    public function name(): string
    {
        return 'google_translate_get_current_user';
    }

    public function description(): string
    {
        return 'Verify the Google Cloud Translation API key and get connection information. Confirms the API key is valid and the service is reachable.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Translate integration is not configured.');
            }

            // Use the list supported languages endpoint as a lightweight health check
            $result = $this->service->listSupportedLanguages('en');

            $languages = $result['data']['languages'] ?? [];
            $languageCount = count($languages);

            return ToolResult::success([
                'status' => 'connected',
                'service' => 'Google Cloud Translation API',
                'supported_languages' => $languageCount,
                'message' => "API key is valid. {$languageCount} languages available.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
