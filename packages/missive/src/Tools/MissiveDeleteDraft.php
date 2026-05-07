<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Delete a Missive draft.
 */
class MissiveDeleteDraft extends AbstractMissiveTool
{
    public const NAME = 'missive_delete_draft';
    public const DESCRIPTION = 'Delete a Missive draft by ID.';
    public const PARAMETERS = [
        'draft_id' => ['type' => 'string', 'required' => true, 'description' => 'Draft UUID.'],
    ];

    /**
     * Delete a draft.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteDraft($this->requiredString($args, 'draft_id', 'draft_id'));
    }
}
