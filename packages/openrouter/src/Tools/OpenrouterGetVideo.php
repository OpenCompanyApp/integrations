<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Poll OpenRouter video generation status. */
class OpenrouterGetVideo extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_get_video';
    protected const DESCRIPTION = 'Poll video generation status by job ID.';
    protected const METHOD = 'getVideo';
    protected const ARGUMENTS = ['job_id'];
    protected const REQUIRED = ['job_id'];
}
