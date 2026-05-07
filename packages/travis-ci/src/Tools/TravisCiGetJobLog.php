<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Get a Travis CI job log.
 */
class TravisCiGetJobLog extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_get_job_log';
    protected const DESCRIPTION = 'Get a Travis CI job log as JSON metadata or plain text.';
    protected const METHOD = 'getJobLog';
    protected const REQUIRED = ['job_id'];
    protected const PARAMETERS = [
        'job_id' => ['type' => 'integer', 'required' => true, 'description' => 'Travis job id.'],
        'plain_text' => ['type' => 'boolean', 'description' => 'Return /log.txt with Accept: text/plain.'],
        'query' => ['type' => 'object', 'description' => 'Optional include or log.token query.'],
    ];
}
