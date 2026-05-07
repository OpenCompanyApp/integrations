<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Retrieve an Eden AI V3 Universal AI async job.
 */
class EdenAiGetUniversalAiJob extends AbstractEdenAiTool
{
    public const NAME = 'edenai_get_universal_ai_job';
    public const DESCRIPTION = 'Get an Eden AI V3 Universal AI async job result.';
    public const PARAMETERS = [
        'job_id' => ['type' => 'string', 'required' => true, 'description' => 'Public async job ID.'],
    ];

    /**
     * Retrieve an async job.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getUniversalAiJob($this->requiredString($args, 'job_id', 'job_id'));
    }
}
