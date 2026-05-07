<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * Get metadata for the authenticated ReadMe project.
 */
class ReadMeGetProjectMetadata extends AbstractReadMeTool
{
    protected const NAME = 'readme_get_project_metadata';
    protected const DESCRIPTION = 'Get metadata for the current ReadMe project.';
    protected const METHOD = 'getProjectMetadata';
}
