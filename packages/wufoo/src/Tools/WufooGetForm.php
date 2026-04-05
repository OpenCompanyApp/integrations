<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a specific Wufoo form.
 *
 * Calls GET /forms/{id}.json on the Wufoo API and returns the full form
 * definition including fields, settings, and metadata.
 */
class WufooGetForm implements Tool
{
    /**
     * Create a new WufooGetForm tool instance.
     *
     * @param  WufooService  $service  The Wufoo API service instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wufoo_get_form';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific Wufoo form by its identifier. Returns the full form definition including fields, settings, and metadata.';
    }

    /**
     * Get the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or identifier (e.g., "q1w2e3r4t5y6").'],
        ];
    }

    /**
     * Execute the get form operation.
     *
     * @param  array<string, mixed>  $args  The tool arguments. Must contain 'form_id'.
     * @return ToolResult The result containing the form details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $formId = $args['form_id'] ?? '';

            if (empty($formId)) {
                return ToolResult::error('form_id is required.');
            }

            $result = $this->service->getForm($formId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
