<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Create one or more Missive canned responses.
 */
class MissiveCreateResponses extends AbstractMissiveTool
{
    public const NAME = 'missive_create_responses';
    public const DESCRIPTION = 'Create one or more Missive canned responses.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Response creation payload.'],
    ];

    /**
     * Create responses.
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

        return $this->service->createResponses($body);
    }
}
