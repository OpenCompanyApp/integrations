<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

/**
 * Call an ElevenLabs DELETE endpoint.
 */
class ElevenLabsApiDelete extends AbstractElevenLabsTool
{
    public const NAME = 'elevenlabs_api_delete';
    public const DESCRIPTION = 'Call a documented ElevenLabs DELETE endpoint relative to /v1.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /history/{history_item_id}.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];

    /**
     * Call a DELETE endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiDelete($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
