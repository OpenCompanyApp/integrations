<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Call a documented Manychat GET endpoint.
 */
class ManyChatApiGet extends AbstractManyChatTool
{
    public const NAME = 'manychat_api_get';
    public const DESCRIPTION = 'Call a documented Manychat GET endpoint relative to the configured API base URL.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /fb/page/getOtnTopics.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call the endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiGet($this->requiredString($args, 'path'), $this->arrayArg($args, 'params'));
    }
}
