<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Delete one ElevenLabs dubbing project.
 */
class ElevenLabsDeleteDubbing extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_delete_dubbing';
    public const DESCRIPTION = 'Delete an ElevenLabs dubbing project by ID.';
    public const PARAMETERS = [
        'dubbing_id' => ['type' => 'string', 'required' => true, 'description' => 'Dubbing project ID.'],
    ];

    /**
     * Delete a dubbing project.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteDubbing($this->requiredString($args, 'dubbing_id', 'dubbing_id'));
    }
}
