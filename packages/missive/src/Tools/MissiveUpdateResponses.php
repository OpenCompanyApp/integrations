<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Update one or more Missive canned responses.
 */
class MissiveUpdateResponses extends AbstractMissiveTool
{
    public const NAME = 'missive_update_responses';
    public const DESCRIPTION = 'Update one or more Missive canned responses by comma-separated IDs.';
    public const PARAMETERS = [
        'response_ids' => ['type' => 'string', 'required' => true, 'description' => 'One or more response IDs, comma separated.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Response attributes to update.'],
    ];

    /**
     * Update responses.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body');
        if ($body === []) {
            throw new \InvalidArgumentException('body is required.');
        }

        return $this->service->updateResponses($this->requiredString($args, 'response_ids', 'response_ids'), $body);
    }
}
