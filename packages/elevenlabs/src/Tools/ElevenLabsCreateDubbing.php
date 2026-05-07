<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Create an ElevenLabs dubbing project.
 */
class ElevenLabsCreateDubbing extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_create_dubbing';
    public const DESCRIPTION = 'Create an ElevenLabs dubbing project from a source URL or uploaded files.';
    public const PARAMETERS = [
        'fields' => ['type' => 'object', 'required' => true, 'description' => 'Dubbing fields such as source_url, target_lang, source_lang, name, num_speakers, and mode.'],
        'files' => ['type' => 'object', 'description' => 'Optional local file fields: file, csv_file, foreground_audio_file, background_audio_file.'],
    ];

    /**
     * Create a dubbing project.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createDubbing(
            $this->requiredArray($args, 'fields', 'fields'),
            $this->arrayArg($args, 'files')
        );
    }
}
