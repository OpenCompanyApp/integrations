<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * List notes for one Recruitee candidate.
 */
class RecruiteeListCandidateNotes extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_list_candidate_notes';
    public const DESCRIPTION = 'List notes for a specific Recruitee candidate.';
    public const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Candidate ID.'],
    ];

    /**
     * List candidate notes.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listCandidateNotes($this->requiredInt($args, 'id', 'candidate ID'));
    }
}
