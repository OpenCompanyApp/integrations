<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Get an Ashby file URL. */
class AshbyGetFile extends AbstractAshbyTool
{
    protected const NAME = 'ashby_get_file';
    protected const DESCRIPTION = 'Retrieve the URL for a file associated with a candidate.';
    protected const ENDPOINT = '/file.info';
    protected const REQUIRED = ['fileId'];
    protected const BODY_KEYS = ['fileId'];
    protected const PARAMETERS = [
        'fileId' => ['type' => 'string', 'required' => true, 'description' => 'File UUID.'],
    ];
}
