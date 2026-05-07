<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Dialpad Number -- Auto-Assign.
 *
 * Executes the official Dialpad API operation numbers.assign_target_number.post.
 */
class DialpadNumbersAssignTargetNumberPost extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_numbers_assign_target_number_post';
}
