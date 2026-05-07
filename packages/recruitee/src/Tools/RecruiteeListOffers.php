<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * List company offers from Recruitee.
 */
class RecruiteeListOffers extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_list_offers';
    public const DESCRIPTION = 'List company offers (jobs or talent pools) from Recruitee.';
    public const PARAMETERS = [
        'status' => ['type' => 'string', 'description' => 'Optional offer status filter, such as draft, internal, published, closed, or archived.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum number of results.'],
    ];

    /**
     * List company offers.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listOffers($this->arrayArg($args, 'params') + array_filter([
            'status' => $args['status'] ?? null,
            'page' => isset($args['page']) ? (int) $args['page'] : null,
            'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }
}
