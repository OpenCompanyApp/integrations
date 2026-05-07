<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Get one ElevenLabs dubbing project.
 */
class ElevenLabsGetDubbing extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_get_dubbing';
    public const DESCRIPTION = 'Get an ElevenLabs dubbing project by ID.';
    public const PARAMETERS = [
        'dubbing_id' => ['type' => 'string', 'required' => true, 'description' => 'Dubbing project ID.'],
    ];

    /**
     * Get a dubbing project.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getDubbing($this->requiredString($args, 'dubbing_id', 'dubbing_id'));
    }
}
