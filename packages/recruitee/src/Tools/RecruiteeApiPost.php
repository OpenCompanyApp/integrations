<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Call a documented Recruitee POST endpoint.
 */
class RecruiteeApiPost extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_api_post';
    public const DESCRIPTION = 'Call a documented company-scoped Recruitee POST endpoint relative to /c/{company_id}.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /attachments.'],
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
