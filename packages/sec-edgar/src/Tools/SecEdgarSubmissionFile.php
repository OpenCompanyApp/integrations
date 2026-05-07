<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

/**
 * Retrieve an additional SEC EDGAR submissions history file.
 */
class SecEdgarSubmissionFile extends AbstractSecEdgarTool
{
    protected const NAME = 'sec_edgar_submission_file';
    protected const DESCRIPTION = 'Retrieve an additional paginated submissions JSON file listed in a submissions response.';
    protected const METHOD = 'submissionFile';
    protected const REQUIRED = ['file'];
    protected const PARAMETERS = [
        'file' => ['type' => 'string', 'required' => true, 'description' => 'File name such as CIK0000320193-submissions-001.json.'],
    ];
}
