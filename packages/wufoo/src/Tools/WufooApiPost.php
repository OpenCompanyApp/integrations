<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Call a documented Wufoo API v3 POST endpoint.
 */
class WufooApiPost extends AbstractWufooTool
{
    public const NAME = 'wufoo_api_post';
    public const DESCRIPTION = 'Call a documented Wufoo API v3 POST endpoint relative to /api/v3 with form-encoded body data.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /forms/{id}/entries.json.'],
        'body' => ['type' => 'object', 'description' => 'Form-encoded body fields.'],
    ];

    /**
     * Call a POST endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPost(
            $this->requiredString($args, 'path', 'path'),
            $this->arrayArg($args, 'body'),
        );
    }
}
