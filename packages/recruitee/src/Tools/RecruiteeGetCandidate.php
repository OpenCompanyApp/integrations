<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Get a single Recruitee candidate by ID.
 */
class RecruiteeGetCandidate extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_get_candidate';
    public const DESCRIPTION = 'Get details for a specific Recruitee candidate.';
    public const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Candidate ID.'],
    ];

    /**
     * Get one candidate.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getCandidate($this->requiredInt($args, 'id', 'candidate ID'));
    }
}
