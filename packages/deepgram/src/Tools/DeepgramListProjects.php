<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * List Deepgram projects visible to the API key.
 */
class DeepgramListProjects extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_list_projects';
    protected const DESCRIPTION = 'List Deepgram projects associated with the API key.';
    protected const SERVICE_METHOD = 'listProjects';
}
