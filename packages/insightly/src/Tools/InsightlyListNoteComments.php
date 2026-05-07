<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List comments for an Insightly note.
 */
class InsightlyListNoteComments extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_note_comments';
    protected string $toolDescription = 'List comments for an Insightly note.';
    protected string $path = '/v3.1/Notes/{id}/Comments';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly note ID.'],
    ];
}
