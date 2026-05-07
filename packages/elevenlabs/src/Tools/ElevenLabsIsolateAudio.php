<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Isolate speech from noisy audio.
 */
class ElevenLabsIsolateAudio extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_isolate_audio';
    public const DESCRIPTION = 'Remove background noise from an audio file using ElevenLabs audio isolation.';
    public const PARAMETERS = [
        'audio_path' => ['type' => 'string', 'required' => true, 'description' => 'Local audio file path.'],
        'fields' => ['type' => 'object', 'description' => 'Multipart fields such as file_format and preview_b64.'],
    ];

    /**
     * Isolate audio.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->isolateAudio(
            $this->requiredString($args, 'audio_path', 'audio_path'),
            $this->arrayArg($args, 'fields')
        );
    }
}
