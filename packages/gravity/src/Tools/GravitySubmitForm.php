<?php

namespace OpenCompany\Integrations\Gravity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gravity\GravityService;

/**
 * Submit field values to a Gravity form.
 */
class GravitySubmitForm implements Tool
{
    /**
     * @param  GravityService  $service  The Gravity API client.
     */
    public function __construct(
        private GravityService $service,
    ) {}

    public function name(): string
    {
        return 'gravity_submit_form';
    }

    public function description(): string
    {
        return 'Submit a Gravity form with field values.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form ID.'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Form field values keyed by field name or ID.'],
        ];
    }

    /**
     * Submit a form.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gravity integration is not configured.');
            }
            if (empty($args['form_id'])) {
                return ToolResult::error('Form ID is required.');
            }
            if (empty($args['data']) || !is_array($args['data'])) {
                return ToolResult::error('Form data object is required.');
            }

            return ToolResult::success($this->service->submitForm((string) $args['form_id'], $args['data']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
