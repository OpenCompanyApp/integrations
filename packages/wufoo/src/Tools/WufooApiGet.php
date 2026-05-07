<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Call a documented Wufoo API v3 GET endpoint.
 */
class WufooApiGet extends AbstractWufooTool
{
    public const NAME = 'wufoo_api_get';
    public const DESCRIPTION = 'Call a documented Wufoo API v3 GET endpoint relative to /api/v3.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /forms.json or /reports/{id}/widgets.json.'],
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
        return $this->service->apiGet(
            $this->requiredString($args, 'path', 'path'),
            $this->arrayArg($args, 'params'),
        );
    }
}
