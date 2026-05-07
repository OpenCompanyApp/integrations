<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Create a comment on an Insightly note.
 */
class InsightlyCreateNoteComment extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_create_note_comment';
    protected string $toolDescription = 'Create a comment on an Insightly note.';
    protected string $method = 'POST';
    protected string $path = '/v3.1/Notes/{id}/Comments';
    protected array $required = ['id', 'BODY'];
    protected array $bodyParams = ['BODY'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly note ID.'],
        'BODY' => ['type' => 'string', 'required' => true, 'description' => 'Comment body.'],
    ];
}
