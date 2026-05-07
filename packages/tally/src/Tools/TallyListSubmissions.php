<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List submissions for a specific Tally form with pagination.
 */
class TallyListSubmissions extends AbstractTallyTool implements Tool
{
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
                'description' => 'Number of submissions per page (default: 50, max: 500).',
            ],
            'filter' => [
                'type' => 'string',
                'description' => 'Submission status filter.',
                'enum' => ['all', 'completed', 'partial'],
            ],
            'start_date' => [
                'type' => 'string',
                'description' => 'Return submissions submitted on or after this ISO 8601 timestamp.',
            ],
            'end_date' => [
                'type' => 'string',
                'description' => 'Return submissions submitted on or before this ISO 8601 timestamp.',
            ],
            'after_id' => [
                'type' => 'string',
                'description' => 'Return submissions after this submission ID.',
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
        return $this->run(fn (): array => $this->service->listSubmissions(
            $this->requiredString($args, 'form_id', 'Form ID'),
            array_merge(
                $this->params($args, ['page', 'limit', 'filter']),
                $this->mappedPayload($args, [
                    'start_date' => 'startDate',
                    'end_date' => 'endDate',
                    'after_id' => 'afterId',
                ]),
            ),
        ));
    }
}
