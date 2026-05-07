<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Call an ElevenLabs POST endpoint.
 */
class ElevenLabsApiPost extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_api_post';
    public const DESCRIPTION = 'Call a documented ElevenLabs POST endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /text-to-speech/{voice_id}/with-timestamps.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a POST endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPost($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
