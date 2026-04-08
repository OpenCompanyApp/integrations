<?php

namespace OpenCompany\Integrations\Formstack\Tools;

use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FormstackListSubmissions — List submissions for a specific Formstack form.
 *
 * Returns a paginated list of submissions with their IDs, timestamps,
 * and optionally expanded field data. Use this to review form entries.
 *
 * @see https://www.formstack.com/docs/api/v2/submission#get-submissions-for-a-form
 */
class FormstackListSubmissions implements Tool
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
        return 'formstack_list_submissions';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List submissions for a specific Formstack form. Returns submission IDs, timestamps, and optionally expanded field data.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'integer', 'required' => true, 'description' => 'The numeric ID of the form.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of submissions per page (default: 25, max: 200).'],
            'expand_data' => ['type' => 'boolean', 'description' => 'Whether to expand submission data with field labels (default: false).'],
        ];
    }

    /**
     * Execute the tool — list submissions for a form from Formstack.
     *
     * @param  array{form_id: int, page?: int, per_page?: int, expand_data?: bool}  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Formstack integration is not configured.');
            }

            $formId = (int) $args['form_id'];
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;
            $expandData = !empty($args['expand_data']);

            $result = $this->service->listSubmissions($formId, $page, $perPage, $expandData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
