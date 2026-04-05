<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * DeepL usage tool.
 *
 * Retrieves the current API usage for the configured DeepL account,
 * including character count used and character limit for the billing period.
 */
class DeepLGetUsage implements Tool
{
    /**
     * Create a new DeepLGetUsage tool instance.
     */
    public function __construct(
        private DeepLService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'deepl_get_usage';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Check your DeepL API usage. Returns the character count used and character limit for the current billing period.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the usage query.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $result = $this->service->getUsage();

            $used = $result['character_count'] ?? 0;
            $limit = $result['character_limit'] ?? 0;
            $percentage = $limit > 0 ? round(($used / $limit) * 100, 1) : 0;

            return ToolResult::success([
                'character_count' => $used,
                'character_limit' => $limit,
                'percentage_used' => $percentage,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
