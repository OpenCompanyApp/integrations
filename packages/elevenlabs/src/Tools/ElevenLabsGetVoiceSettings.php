<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Get a voice's default settings.
 */
class ElevenLabsGetVoiceSettings extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_get_voice_settings';
    public const DESCRIPTION = 'Get default voice settings for a specific ElevenLabs voice.';
    public const PARAMETERS = [
        'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Voice ID.'],
    ];

    /**
     * Get voice settings.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getVoiceSettings($this->requiredString($args, 'voice_id', 'voice_id'));
    }
}
