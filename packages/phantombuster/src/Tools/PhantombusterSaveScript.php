<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a Phantombuster script.
 */
class PhantombusterSaveScript extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_save_script';
    }

    public function description(): string
    {
        return 'Create or update a Phantombuster script using official /scripts/save fields.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Official /scripts/save payload.'],
        ];
    }

    /**
     * Save a script.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!is_array($args['payload'] ?? null) || $args['payload'] === []) {
                return ToolResult::error('payload is required.');
            }

            return ToolResult::success($this->service->saveScript($args['payload']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
