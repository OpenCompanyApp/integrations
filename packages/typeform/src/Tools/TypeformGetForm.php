<?php

namespace OpenCompany\Integrations\Typeform\Tools;

use OpenCompany\Integrations\Typeform\TypeformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Typeform form.
 *
 * Retrieves the full form definition including fields, settings,
 * and design configuration.
 */
class TypeformGetForm implements Tool
{
    /**
     * @param  TypeformService  $service  The Typeform API client
     */
    public function __construct(
        private TypeformService $service,
    ) {}

    public function name(): string
    {
        return 'typeform_get_form';
    }

    public function description(): string
    {
        return 'Get details of a specific Typeform form including its fields and settings.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the Typeform form.'],
        ];
    }

    /**
     * Get a single form by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Typeform integration is not configured.');
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
