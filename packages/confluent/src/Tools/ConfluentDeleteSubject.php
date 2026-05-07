<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Deletes the specified subject and its associated compatibility level if registered. It is recommended to use this API only when a topic needs to be recycled or in development environment.
 */
class ConfluentDeleteSubject extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_subject';
}
