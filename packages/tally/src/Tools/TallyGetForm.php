<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\Integrations\Tally\TallyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get full details for a specific Tally form by its ID.
 *
 * Returns the complete form structure including all fields, settings,
 * and configuration.
 */
class TallyGetForm implements Tool
{
    public function __construct(
        private TallyService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'tally_get_form';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details for a specific Tally form, including all fields, structure, and settings. Use this to understand a form\'s layout before querying submissions.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID (e.g., "mVlDK4").'],
        ];
    }

    /**
     * Execute the get_form tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $result = $this->service->getForm($args['form_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
