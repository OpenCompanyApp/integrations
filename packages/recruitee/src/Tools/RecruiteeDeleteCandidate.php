<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Delete a candidate from Recruitee.
 */
class RecruiteeDeleteCandidate extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_delete_candidate';
    public const DESCRIPTION = 'Delete a Recruitee candidate by ID. This permanently removes the candidate in Recruitee.';
    public const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Candidate ID.'],
    ];

    /**
     * Delete a candidate.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteCandidate($this->requiredInt($args, 'id', 'candidate ID'));
    }
}
