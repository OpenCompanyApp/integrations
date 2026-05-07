<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * List candidates from Recruitee.
 */
class RecruiteeListCandidates extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_list_candidates';
    public const DESCRIPTION = 'List candidates from Recruitee. For larger or filtered searches, use recruitee_search_candidates.';
    public const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum number of results.'],
        'offset' => ['type' => 'integer', 'description' => 'Result offset for the legacy candidates endpoint.'],
    ];

    /**
     * List candidates.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listCandidates(array_filter([
            'page' => isset($args['page']) ? (int) $args['page'] : null,
            'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
            'offset' => isset($args['offset']) ? (int) $args['offset'] : null,
        ], static fn ($value): bool => $value !== null));
    }
}
