<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Call an Eden AI V2 GET endpoint.
 */
class EdenAiApiGet extends AbstractEdenAiTool
{
    public const NAME = 'edenai_api_get';
    public const DESCRIPTION = 'Call a legacy Eden AI V2 GET endpoint relative to /v2.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /user.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call a V2 GET endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiGet($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'params'));
    }
}
