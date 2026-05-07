<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Search candidates through Recruitee's newer candidate search endpoint.
 */
class RecruiteeSearchCandidates extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_search_candidates';
    public const DESCRIPTION = 'Search Recruitee candidates with the newer /search/new/candidates endpoint.';
    public const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Maximum number of candidates.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'filters_json' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Recruitee filter JSON strings.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort key such as created_at_desc or candidate_name_asc.'],
    ];

    /**
     * Search candidates.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->searchCandidates(array_filter([
            'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
            'page' => isset($args['page']) ? (int) $args['page'] : null,
            'filters_json' => $args['filters_json'] ?? null,
            'sort_by' => $args['sort_by'] ?? null,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }
}
