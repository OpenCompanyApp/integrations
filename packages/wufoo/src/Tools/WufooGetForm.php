<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WufooGetForm implements Tool
{
    /**
     * Create a new WufooGetForm tool instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool's machine name.
     */
    public function name(): string
    {
        return 'wufoo_get_form';
    }

    /**
     * Get a description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific Wufoo form by its hash identifier. Returns form structure, fields, and metadata.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or unique identifier (e.g., "z1k08xw1ubbvkt").'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $result = $this->service->getForm($args['form_id']);
            $forms = $result['Forms'] ?? [];

            if (empty($forms)) {
                return ToolResult::error("Form '{$args['form_id']}' not found.");
            }

            return ToolResult::success([
                'form' => $forms[0],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
