<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Blocked Numbers -- List.
 *
 * Executes the official Dialpad API operation blockednumbers.list.
 */
class DialpadBlockednumbersList extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_blockednumbers_list';
}
