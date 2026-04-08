<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get current DeepL API usage information.
 *
 * Returns the number of characters translated and the character limit for the billing period.
 */
class DeepLGetUsage implements Tool
{
    public function __construct(
        private DeepLService $service,
    ) {}

    public function name(): string
    {
        return 'deepl_get_usage';
    }

    public function description(): string
    {
        return 'Get current DeepL API usage. Returns the number of characters translated and the character limit for the current billing period.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $result = $this->service->getUsage();

            $characterCount = $result['character_count'] ?? 0;
            $characterLimit = $result['character_limit'] ?? 0;
            $percentage = $characterLimit > 0 ? round(($characterCount / $characterLimit) * 100, 1) : 0;

            return ToolResult::success([
                'character_count' => $characterCount,
                'character_limit' => $characterLimit,
                'usage_percentage' => $percentage,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
