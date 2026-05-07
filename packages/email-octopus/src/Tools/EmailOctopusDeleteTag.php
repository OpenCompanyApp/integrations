<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Delete a tag from an EmailOctopus list. */
class EmailOctopusDeleteTag extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_delete_tag';
    protected const DESCRIPTION = 'Delete a tag from an EmailOctopus mailing list.';
    protected const METHOD = 'deleteTag';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'The tag name.']];
}
