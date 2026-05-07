<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one RingCentral extension call log record.
 */
class RingCentralGetCall extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_get_call';
    }

    public function description(): string
    {
        return 'Get a single call log record for the authenticated RingCentral extension.';
    }

    public function parameters(): array
    {
        return [
            'call_id' => ['type' => 'string', 'required' => true, 'description' => 'Call log record ID.'],
        ];
    }

    /**
     * Fetch one call log record.
     *
     * @param  array<string, mixed>  $args  Tool arguments (call_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['call_id'])) {
                return ToolResult::error('call_id is required.');
            }

            return ToolResult::success($this->service->getCall((string) $args['call_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
