<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Generate sound effects from text.
 */
class ElevenLabsCreateSoundEffect extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_create_sound_effect';
    public const DESCRIPTION = 'Generate a sound effect from a text prompt.';
    public const PARAMETERS = [
        'text' => ['type' => 'string', 'required' => true, 'description' => 'Sound effect prompt.'],
        'loop' => ['type' => 'boolean', 'description' => 'Whether to generate a seamless loop.'],
        'duration_seconds' => ['type' => 'number', 'description' => 'Desired duration from 0.5 to 30 seconds.'],
        'prompt_influence' => ['type' => 'number', 'description' => 'Prompt influence from 0 to 1.'],
        'model_id' => ['type' => 'string', 'description' => 'Sound generation model ID.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters such as output_format.'],
    ];

    /**
     * Create a sound effect.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = ['text' => $this->requiredString($args, 'text', 'text')];

        foreach (['loop', 'duration_seconds', 'prompt_influence', 'model_id'] as $key) {
            if (array_key_exists($key, $args)) {
                $body[$key] = $args[$key];
            }
        }

        return $this->service->createSoundEffect($body, $this->arrayArg($args, 'query'));
    }
}
