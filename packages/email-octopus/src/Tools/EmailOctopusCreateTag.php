<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Create a tag on an EmailOctopus list. */
class EmailOctopusCreateTag extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_create_tag';
    protected const DESCRIPTION = 'Create a tag on an EmailOctopus mailing list.';
    protected const METHOD = 'createTag';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'The tag name.']];
}
