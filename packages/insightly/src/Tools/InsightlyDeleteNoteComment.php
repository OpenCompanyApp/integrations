<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete a comment from an Insightly note.
 */
class InsightlyDeleteNoteComment extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_note_comment';
    protected string $toolDescription = 'Delete a comment from an Insightly note.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Notes/{id}/Comment/{childEntityId}';
    protected array $required = ['id', 'childEntityId'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly note ID.'],
        'childEntityId' => ['type' => 'integer', 'required' => true, 'description' => 'Comment ID.'],
    ];
}
