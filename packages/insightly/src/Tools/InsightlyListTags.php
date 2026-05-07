<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly tags.
 */
class InsightlyListTags extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_tags';
    protected string $toolDescription = 'List Insightly tags.';
    protected string $path = '/v3.1/Tags';
}
