<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Delete one or more Missive canned responses.
 */
class MissiveDeleteResponses extends AbstractMissiveTool
{
    public const NAME = 'missive_delete_responses';
    public const DESCRIPTION = 'Delete one or more Missive canned responses by comma-separated IDs.';
    public const PARAMETERS = [
        'response_ids' => ['type' => 'string', 'required' => true, 'description' => 'One or more response IDs, comma separated.'],
    ];

    /**
     * Delete responses.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteResponses($this->requiredString($args, 'response_ids', 'response_ids'));
    }
}
