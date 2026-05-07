<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Create a candidate in Recruitee.
 */
class RecruiteeCreateCandidate extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_create_candidate';
    public const DESCRIPTION = 'Manually add a candidate to Recruitee and optionally assign offer IDs.';
    public const PARAMETERS = [
        'candidate' => ['type' => 'object', 'required' => true, 'description' => 'Candidate object accepted by Recruitee.'],
        'offers' => ['type' => 'array', 'items' => ['type' => 'integer'], 'description' => 'Optional offer IDs to assign the candidate to.'],
    ];

    /**
     * Create a candidate.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $offers = is_array($args['offers'] ?? null) ? array_map('intval', $args['offers']) : null;

        return $this->service->createCandidate(
            $this->requiredArray($args, 'candidate', 'candidate'),
            $offers
        );
    }
}
