<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Transcribe audio using ElevenLabs speech-to-text.
 */
class ElevenLabsSpeechToText extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_speech_to_text';
    public const DESCRIPTION = 'Transcribe audio or video using ElevenLabs speech-to-text.';
    public const PARAMETERS = [
        'audio_path' => ['type' => 'string', 'required' => true, 'description' => 'Local audio or video file path.'],
        'fields' => ['type' => 'object', 'description' => 'Multipart fields such as model_id, language_code, diarize, tag_audio_events, keyterms, and entity_detection.'],
    ];

    /**
     * Transcribe audio.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->speechToText(
            $this->requiredString($args, 'audio_path', 'audio_path'),
            $this->arrayArg($args, 'fields')
        );
    }
}
