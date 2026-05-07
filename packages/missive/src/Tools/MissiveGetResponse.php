<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Get a Missive canned response.
 */
class MissiveGetResponse extends AbstractMissiveTool
{
    public const NAME = 'missive_get_response';
    public const DESCRIPTION = 'Get a Missive canned response by ID.';
    public const PARAMETERS = [
        'response_id' => ['type' => 'string', 'required' => true, 'description' => 'Response UUID.'],
    ];

    /**
     * Get a response.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getResponse($this->requiredString($args, 'response_id', 'response_id'));
    }
}
