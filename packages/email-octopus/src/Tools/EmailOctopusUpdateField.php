<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Update a field on an EmailOctopus list. */
class EmailOctopusUpdateField extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_update_field';
    protected const DESCRIPTION = 'Update a custom field on an EmailOctopus mailing list.';
    protected const METHOD = 'updateField';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'Field tag.'], 'type' => ['type' => 'string', 'enum' => ['NUMBER', 'TEXT', 'DATE'], 'description' => 'Field type.'], 'label' => ['type' => 'string', 'description' => 'Human-readable label.'], 'fallback' => ['type' => 'string', 'description' => 'Fallback value.']];
}
