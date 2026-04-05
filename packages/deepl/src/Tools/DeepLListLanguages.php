<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * DeepL list languages tool.
 *
 * Lists all languages supported by DeepL for translation,
 * optionally filtered by source or target type.
 */
class DeepLListLanguages implements Tool
{
    /**
     * Create a new DeepLListLanguages tool instance.
     */
    public function __construct(
        private DeepLService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'deepl_list_languages';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all languages supported by DeepL. Optionally filter by "source" (languages you can translate from) or "target" (languages you can translate to). Returns language codes and names.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Filter by type: "source" (languages that can be translated from) or "target" (languages that can be translated to). Omit for all.'],
        ];
    }

    /**
     * Execute the languages list query.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $type = $args['type'] ?? null;

            if ($type !== null && !in_array($type, ['source', 'target'], true)) {
                return ToolResult::error('type must be "source", "target", or omitted for all languages.');
            }

            $result = $this->service->listLanguages($type);

            $languages = array_map(function (array $lang) {
                return [
                    'code' => $lang['language'] ?? '',
                    'name' => $lang['name'] ?? '',
                    'supports_formality' => $lang['supports_formality'] ?? false,
                ];
            }, $result);

            return ToolResult::success([
                'languages' => $languages,
                'count' => count($languages),
                'type' => $type ?? 'all',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
