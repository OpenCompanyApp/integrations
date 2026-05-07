<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Call an Eden AI V3 GET endpoint.
 */
class EdenAiV3ApiGet extends AbstractEdenAiTool
{
    public const NAME = 'edenai_v3_api_get';
    public const DESCRIPTION = 'Call an Eden AI V3 GET endpoint relative to /v3.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /models or /info.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call a V3 GET endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->v3ApiGet($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'params'));
    }
}
