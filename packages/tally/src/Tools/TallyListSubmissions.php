<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tally\TallyService;

/**
 * List submissions for a specific Tally form with pagination.
 */
class TallyListSubmissions implements Tool
{
    /**
     * @param  TallyService  $service  The Tally API service instance.
     */
    public function __construct(
        private TallyService $service,
    ) {}

    public function name(): string
    {
        return 'tally_list_submissions';
    }

    public function description(): string
    {
        return 'List all submissions for a specific Tally form. Returns respondent answers, submission dates, and metadata. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Tally form ID to retrieve submissions for (e.g., "mVlBRN").',
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default: 1).',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of submissions per page (default: 20, max: 100).',
            ],
        ];
    }

    /**
     * Execute the list submissions request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id, page, limit).
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

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listSubmissions($formId, $page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
