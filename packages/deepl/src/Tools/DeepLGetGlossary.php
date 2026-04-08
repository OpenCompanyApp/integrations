<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific glossary from the DeepL API.
 *
 * Returns glossary metadata including name, language pair, entry count, and creation time.
 */
class DeepLGetGlossary implements Tool
{
    public function __construct(
        private DeepLService $service,
    ) {}

    public function name(): string
    {
        return 'deepl_get_glossary';
    }

    public function description(): string
    {
        return 'Get details of a specific DeepL glossary by ID. Returns glossary name, source/target languages, entry count, and creation timestamp.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The glossary ID (e.g., "a1b2c3d4-e5f6-7890-abcd-ef1234567890").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $id = $args['id'];
            $result = $this->service->getGlossary($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
