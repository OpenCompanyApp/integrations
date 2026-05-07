<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get metadata for one RingCentral extension.
 */
class RingCentralGetExtension extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_get_extension';
    }

    public function description(): string
    {
        return 'Get details for a RingCentral extension by extension ID.';
    }

    public function parameters(): array
    {
        return [
            'extension_id' => ['type' => 'string', 'required' => true, 'description' => 'RingCentral extension ID.'],
        ];
    }

    /**
     * Fetch one extension.
     *
     * @param  array<string, mixed>  $args  Tool arguments (extension_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['extension_id'])) {
                return ToolResult::error('extension_id is required.');
            }

            return ToolResult::success($this->service->getExtension((string) $args['extension_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
