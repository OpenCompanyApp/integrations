<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List supported languages from the DeepL API.
 *
 * Can filter by type to return only source or only target languages.
 */
class DeepLListLanguages implements Tool
{
    public function __construct(
        private DeepLService $service,
    ) {}

    public function name(): string
    {
        return 'deepl_list_languages';
    }

    public function description(): string
    {
        return 'List languages supported by DeepL. Returns language codes and names. Filter by type to get only source or target languages.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Filter by type: "source" for source languages, "target" for target languages. Returns all if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $type = $args['type'] ?? null;
            $result = $this->service->listLanguages($type);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
