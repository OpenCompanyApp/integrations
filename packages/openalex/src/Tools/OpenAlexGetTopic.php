<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

/**
 * Get one OpenAlex topic by OpenAlex ID.
 */
class OpenAlexGetTopic extends AbstractOpenAlexGetTool
{
    protected const NAME = 'openalex_get_topic';
    protected const ENTITY = 'topics';
    protected const LABEL = 'topic';
}
