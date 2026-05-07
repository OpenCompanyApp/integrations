<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Update a candidate CV file in Recruitee.
 */
class RecruiteeUpdateCandidateCv extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_update_candidate_cv';
    public const DESCRIPTION = 'Update a Recruitee candidate CV from a local or remote candidate file payload.';
    public const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Candidate ID.'],
        'candidate' => ['type' => 'object', 'required' => true, 'description' => 'Candidate CV payload accepted by Recruitee.'],
    ];

    /**
     * Update a candidate CV.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateCandidateCv(
            $this->requiredInt($args, 'id', 'candidate ID'),
            $this->requiredArray($args, 'candidate', 'candidate')
        );
    }
}
