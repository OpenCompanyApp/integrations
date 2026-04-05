<?php

namespace OpenCompany\Integrations\Formstack\Tools;

use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FormstackCreateSubmission — Create a new submission for a Formstack form.
 *
 * Submits field values to a specified form. The field keys should match
 * the field identifiers from the form's structure (use Get Form to discover
 * field keys). Returns the created submission details.
 *
 * @see https://www.formstack.com/docs/api/v2/submission#create-a-submission
 */
class FormstackCreateSubmission implements Tool
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
        return 'formstack_create_submission';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new submission for a Formstack form. Pass field values using the field keys from the form structure. Use Get Form first to discover available fields.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'integer', 'required' => true, 'description' => 'The numeric ID of the form to submit to.'],
            'fields' => ['type' => 'object', 'required' => true, 'description' => 'Object with field keys and their values. E.g. {"field_123456": "John Doe", "field_234567": "john@example.com"}. Use Get Form to find field keys.'],
        ];
    }

    /**
     * Execute the tool — create a submission on Formstack.
     *
     * @param  array{form_id: int, fields: array<string, mixed>}  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Formstack integration is not configured.');
            }

            $formId = (int) $args['form_id'];
            $fields = $args['fields'] ?? [];

            if (empty($fields)) {
                return ToolResult::error('At least one field value is required to create a submission.');
            }

            $result = $this->service->createSubmission($formId, $fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
