<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Get one Insightly note.
 */
class InsightlyGetNote extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_get_note';
    protected string $toolDescription = 'Get an Insightly note by ID.';
    protected string $path = '/v3.1/Notes/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly note ID.'],
    ];
}
