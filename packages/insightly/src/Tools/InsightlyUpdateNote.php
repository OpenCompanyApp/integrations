<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly note.
 */
class InsightlyUpdateNote extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_update_note';
    protected string $toolDescription = 'Update an Insightly note.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/Notes';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'NOTE_ID', 'TITLE', 'BODY'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly note ID.'],
        'TITLE' => ['type' => 'string', 'description' => 'Note title.'],
        'BODY' => ['type' => 'string', 'description' => 'Note body.'],
    ];
}
