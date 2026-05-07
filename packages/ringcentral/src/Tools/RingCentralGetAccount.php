<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get account metadata for the authenticated RingCentral token.
 */
class RingCentralGetAccount extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_get_account';
    }

    public function description(): string
    {
        return 'Get RingCentral account metadata for the authenticated token.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch account metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->getAccount());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
