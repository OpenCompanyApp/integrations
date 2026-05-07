<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Update a candidate in Recruitee.
 */
class RecruiteeUpdateCandidate extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_update_candidate';
    public const DESCRIPTION = 'Update a Recruitee candidate by ID.';
    public const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Candidate ID.'],
        'candidate' => ['type' => 'object', 'required' => true, 'description' => 'Candidate fields accepted by Recruitee.'],
    ];

    /**
     * Update a candidate.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateCandidate(
            $this->requiredInt($args, 'id', 'candidate ID'),
            $this->requiredArray($args, 'candidate', 'candidate')
        );
    }
}
