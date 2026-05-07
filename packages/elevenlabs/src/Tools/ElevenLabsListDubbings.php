<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * List ElevenLabs dubbing projects.
 */
class ElevenLabsListDubbings extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_list_dubbings';
    public const DESCRIPTION = 'List ElevenLabs dubbing projects available to the authenticated user.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List dubbings.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listDubbings($this->arrayArg($args, 'params'));
    }
}
