<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Rename a tag on an EmailOctopus list. */
class EmailOctopusUpdateTag extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_update_tag';
    protected const DESCRIPTION = 'Rename a tag on an EmailOctopus mailing list.';
    protected const METHOD = 'updateTag';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'Existing tag name.'], 'new_tag' => ['type' => 'string', 'required' => true, 'description' => 'New tag name.']];
}
