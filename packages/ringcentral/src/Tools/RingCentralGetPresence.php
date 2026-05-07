<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get telephony and user presence for the authenticated RingCentral extension.
 */
class RingCentralGetPresence extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_get_presence';
    }

    public function description(): string
    {
        return 'Get presence for the authenticated RingCentral extension, including telephony status and user status when available.';
    }

    public function parameters(): array
    {
        return [
            'detailedTelephonyState' => ['type' => 'boolean', 'description' => 'Request detailed telephony state when supported.'],
        ];
    }

    /**
     * Fetch extension presence.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->getPresence($this->only($args, ['detailedTelephonyState'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
