<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Convert text to speech with character-level timing.
 */
class ElevenLabsTextToSpeechWithTimestamps extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_text_to_speech_with_timestamps';
    public const DESCRIPTION = 'Generate speech with character-level timing information for synchronization.';
    public const PARAMETERS = [
        'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Voice ID.'],
        'text' => ['type' => 'string', 'required' => true, 'description' => 'Text to synthesize.'],
        'model_id' => ['type' => 'string', 'description' => 'Model ID.'],
        'body' => ['type' => 'object', 'description' => 'Additional request body fields such as seed, language_code, previous_text, and voice_settings.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters such as output_format or enable_logging.'],
    ];

    /**
     * Generate timed speech.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body') + [
            'text' => $this->requiredString($args, 'text', 'text'),
        ];

        if (isset($args['model_id'])) {
            $body['model_id'] = (string) $args['model_id'];
        }

        return $this->service->textToSpeechWithTimestamps(
            $this->requiredString($args, 'voice_id', 'voice_id'),
            $body,
            $this->arrayArg($args, 'query')
        );
    }
}
