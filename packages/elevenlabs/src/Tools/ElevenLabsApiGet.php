<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Call an ElevenLabs GET endpoint.
 */
class ElevenLabsApiGet extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_api_get';
    public const DESCRIPTION = 'Call a documented ElevenLabs GET endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /voices or /models.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call a GET endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiGet($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'params'));
    }
}
