<?php

namespace OpenCompany\Integrations\Formstack\Tools;

use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FormstackGetForm — Retrieve details and field structure of a specific Formstack form.
 *
 * Returns the full form definition including all fields, their types,
 * labels, options, and validation rules. Use this to understand a form's
 * structure before creating submissions.
 *
 * @see https://www.formstack.com/docs/api/v2/form#get-a-specific-form
 */
class FormstackGetForm implements Tool
{
    /**
     * @param  FormstackService  $service  The Formstack API service instance.
     */
    public function __construct(
        private FormstackService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'formstack_get_form';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details and field structure of a specific Formstack form. Returns all fields, their types, labels, and options.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'integer', 'required' => true, 'description' => 'The numeric ID of the form to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get form details from Formstack.
     *
     * @param  array{form_id: int}  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Formstack integration is not configured.');
            }

            $formId = (int) $args['form_id'];
            $result = $this->service->getForm($formId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
