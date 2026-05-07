<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Edit a voice's default settings.
 */
class ElevenLabsEditVoiceSettings extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_edit_voice_settings';
    public const DESCRIPTION = 'Edit default settings for a specific ElevenLabs voice.';
    public const PARAMETERS = [
        'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Voice ID.'],
        'settings' => ['type' => 'object', 'required' => true, 'description' => 'Voice settings such as stability, similarity_boost, style, speed, and use_speaker_boost.'],
    ];

    /**
     * Edit voice settings.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->editVoiceSettings(
            $this->requiredString($args, 'voice_id', 'voice_id'),
            $this->requiredArray($args, 'settings', 'settings')
        );
    }
}
