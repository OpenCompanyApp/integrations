<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Get a dubbing transcript in a requested format.
 */
class ElevenLabsGetDubbingTranscript extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_get_dubbing_transcript';
    public const DESCRIPTION = 'Get an ElevenLabs dubbing transcript as srt, webvtt, or json.';
    public const PARAMETERS = [
        'dubbing_id' => ['type' => 'string', 'required' => true, 'description' => 'Dubbing project ID.'],
        'language_code' => ['type' => 'string', 'required' => true, 'description' => 'Transcript language code.'],
        'format_type' => ['type' => 'string', 'enum' => ['srt', 'webvtt', 'json'], 'description' => 'Transcript format. Defaults to json.'],
    ];

    /**
     * Get a dubbing transcript.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getDubbingTranscript(
            $this->requiredString($args, 'dubbing_id', 'dubbing_id'),
            $this->requiredString($args, 'language_code', 'language_code'),
            isset($args['format_type']) ? (string) $args['format_type'] : 'json'
        );
    }
}
