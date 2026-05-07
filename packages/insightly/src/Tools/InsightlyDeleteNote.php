<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Delete an Insightly note.
 */
class InsightlyDeleteNote extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_delete_note';
    protected string $toolDescription = 'Delete an Insightly note by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v3.1/Notes/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly note ID.'],
    ];
}
