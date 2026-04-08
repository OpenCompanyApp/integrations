<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tally\TallyService;

/**
 * Get details of a specific Tally form by its ID.
 */
class TallyGetForm implements Tool
{
    /**
     * @param  TallyService  $service  The Tally API service instance.
     */
    public function __construct(
        private TallyService $service,
    ) {}

    public function name(): string
    {
        return 'tally_get_form';
    }

    public function description(): string
    {
        return 'Get full details of a specific Tally form by its ID, including form structure, fields, and settings.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Tally form ID (e.g., "mVlBRN").',
            ],
        ];
    }

    /**
     * Execute the get form request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $formId = $args['form_id'] ?? '';
            if (empty($formId)) {
                return ToolResult::error('Form ID is required.');
            }

            $result = $this->service->getForm($formId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
