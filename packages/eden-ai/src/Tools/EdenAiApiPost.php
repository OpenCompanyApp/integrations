<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Call an Eden AI V2 POST endpoint.
 */
class EdenAiApiPost extends AbstractEdenAiTool
{
    public const NAME = 'edenai_api_post';
    public const DESCRIPTION = 'Call a legacy Eden AI V2 POST endpoint relative to /v2.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path such as /text/sentiment_analysis.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a V2 POST endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPost($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
