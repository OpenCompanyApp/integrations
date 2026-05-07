<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Transform one voice in an audio file into another ElevenLabs voice.
 */
class ElevenLabsSpeechToSpeech extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_speech_to_speech';
    public const DESCRIPTION = 'Transform audio from one voice to another using ElevenLabs Voice Changer.';
    public const PARAMETERS = [
        'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Target voice ID.'],
        'audio_path' => ['type' => 'string', 'required' => true, 'description' => 'Local audio file path.'],
        'fields' => ['type' => 'object', 'description' => 'Multipart fields such as model_id, seed, file_format, remove_background_noise, and voice_settings JSON.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters such as output_format.'],
    ];

    /**
     * Convert speech to another voice.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->speechToSpeech(
            $this->requiredString($args, 'voice_id', 'voice_id'),
            $this->requiredString($args, 'audio_path', 'audio_path'),
            $this->arrayArg($args, 'fields'),
            $this->arrayArg($args, 'query')
        );
    }
}
